<?php

declare(strict_types=1);

namespace App\Rector;

use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\NullableType;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\UnionType;
use PHPStan\Type\MixedType;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Rector\AbstractRector;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ProtectedGetterToProtectedSetPropertyRector extends AbstractRector
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly StaticTypeMapper $staticTypeMapper,
        private readonly BuilderFactory $builderFactory
    ) {}

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Convert protected properties with getters to public properties with a protected(set) modifier.',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
class SomeClass
{
    protected $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class SomeClass
{
    public protected(set) ?string $name;
}
CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param  Class_  $node
     */
    public function refactor(Node $node): ?Node
    {
        $properties = $node->getProperties();
        $methods = $node->getMethods();
        $propertiesToRemove = [];
        $methodsToRemove = [];
        $propertiesToAdd = [];

        foreach ($properties as $property) {
            if (! $property->isProtected()) {
                continue;
            }

            $propertyName = $this->getName($property);
            $getterName = 'get'.$this->camelCase($propertyName);

            foreach ($methods as $method) {
                if (! $this->isName($method, $getterName)) {
                    continue;
                }
                if (! $method->isPublic()) {
                    continue;
                }
                $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($method);
                $returnType = $phpDocInfo->getReturnType();

                if ($returnType instanceof MixedType) {
                    continue;
                }

                $type = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($returnType, TypeKind::PROPERTY);
                if (! $type) {
                    continue;
                }
                if ($type instanceof NullableType) {
                    continue;
                }
                if ($type instanceof UnionType) {
                    continue;
                }
                $type = new NullableType($type);

                $newProperty = $this->createPropertyWithProtectedSet($propertyName, $type);
                $propertiesToAdd[] = $newProperty;

                $propertiesToRemove[] = $property;
                $methodsToRemove[] = $method;
                break;
            }
        }

        if ($propertiesToAdd === []) {
            return null;
        }

        // Correctly filter out the old nodes
        $node->stmts = array_filter($node->stmts, fn (Stmt $stmt) => ! in_array($stmt, $propertiesToRemove, true) && ! in_array($stmt, $methodsToRemove, true));

        // Add new properties to the top of the class
        $node->stmts = array_merge($propertiesToAdd, $node->stmts);

        return $node;
    }

    private function createPropertyWithProtectedSet(string $name, Node\Identifier|Node\Name|Node\ComplexType $typeNode): Property
    {
        $propertyBuilder = $this->builderFactory->property($name)
            ->makeProtectedSet()
            ->setType($typeNode);

        return $propertyBuilder->getNode();
    }

    private function camelCase(string $str): string
    {
        return str_replace('_', '', ucwords($str, '_'));
    }
}
