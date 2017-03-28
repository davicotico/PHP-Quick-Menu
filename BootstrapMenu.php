<?php

require 'QuickMenu.php';

class BootstrapMenu extends QuickMenu
{
    protected function build($array, $depth=0)
    {
        $str = ($depth===0) ? '<ul'.$this->getAttr('ul-root').'>' : '<ul'. $this->getAttr('ul').'>';
        foreach ($array as $item)
        {
            $isParent = isset($item['children']);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
            $str .= '<li'.$this->getAttr($li)." {$active} >";
            $str .= '<a href="'.$item['href'].'" title="'.$item['title'].'"'. $this->getAttr($a).'>'.$this->getTextItem($item, $isParent).'</a>';
            if ($isParent)
            {
                $str .= $this->build($item['children'], 1);
            }
            $str .='</li>';
        }
        $str .='</ul>';
        return $str;
    }
    
    protected function buildFromResult(array $array, $parent = 0, $level = 0)
    {
        $ul = ($parent===0) ? 'ul-root' : 'ul';
        $str = '<ul'.$this->getAttr($ul).'>';
        foreach ($array[$parent] as $item_id => $item)
        {
            $isParent = isset($array[$item_id]);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            $str.= '<li'.$this->getAttr($li).'>';
            $str.= "<a href=\"{$item['href']}\" target=\"{$item['target']}\"".$this->getAttr($a).'>'.$this->getTextItem($item, $isParent).'</a>';
            if ($isParent)
            {
                $str.= $this->buildFromResult($array, $item_id, $level+2);
            }
            $str.='</li>';
        }
        $str.='</ul>';
        return $str;
    }
}
