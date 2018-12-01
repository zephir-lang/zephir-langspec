<?php declare(strict_types=1);

namespace Zephir\Grammar;

final class Definition implements Renderable
{
    /** @var string */
    private $name;

    /** @var bool */
    private $isLexical;

    /** @var bool */
    private $isOneOf;

    /** @var Rule[] */
    private $rules;

    /**
     * Definition constructor.
     *
     * @param string $name
     * @param bool   $isLexical
     * @param bool   $isOneOf
     * @param Rule[] $rules
     */
    public function __construct(string $name, bool $isLexical, bool $isOneOf, array $rules)
    {
        $this->name = $name;
        $this->isLexical = $isLexical;
        $this->isOneOf = $isOneOf;
        $this->rules = $rules;
    }

    public function render(RenderContext $context): string
    {
        $separator = $this->isLexical ? '::' : ':';
        $oneOf = $this->isOneOf ? ' one of' : '';

        $result = sprintf(
            '<i id="grammar-%s">%s%s%s</i>',
            $this->name,
            $this->name,
            $separator,
            $oneOf
        );

        foreach ($this->rules as $rule) {
            $result .= PHP_EOL . $rule->render($context);
        }

        return $result;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
