<?php

namespace Funnelnek\Core\Module\View;

class HTMLElement
{
    public function __construct(
        protected string $name = '',
        protected string $template = ''
    ) {
    }

    protected const INDENT_SIZE = 2;
    public array $children = [];

    public function parse(int $indent): string
    {
        $html = [];
        $tab = str_repeat(' ', $indent * HTMLElement::INDENT_SIZE);
        $html[] = "{$tab}<{$this->name}>\n";

        if (strlen($this->template) > 0) {
            $html[] = str_repeat($tab, ($indent + 1) * HTMLElement::INDENT_SIZE);
            $html[] = $this->template;
            $html[] = '\n';
        }
        $html[] = "</{$this->name}>";
        return implode('', $html);
    }
}
