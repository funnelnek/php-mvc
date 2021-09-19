<?php

namespace Funnelnek\Core\Module\View;

class ViewBuilder
{
    public function __construct(
        protected string $viewContainer
    ) {
        $this->root = new HTMLElement($viewContainer);
    }

    protected HTMLElement $root;

    public function appendChildView(string $tag, string $template)
    {
        $child = new HTMLElement($tag, $template);
        $this->root->children[] = $child;
        return $this;
    }
}
