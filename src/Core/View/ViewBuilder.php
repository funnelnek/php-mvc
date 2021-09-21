<?php

namespace Funnelnek\Core\Module\View;

class ViewBuilder
{
    public function __construct(
        protected View $view
    ) {
    }

    protected HTMLElement $root;

    public function appendView(string $tag, string $template)
    {
        $child = new HTMLElement($tag, $template);
        $this->root->children[] = $child;
        return $this;
    }
}
