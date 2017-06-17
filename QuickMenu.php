<?php

/**
 * Class Quick Menu
 * @author David Ticona Saravia <davicotico@gmail.com>
 * @version 0.7 (03/2017)
 */
class QuickMenu
{

    private $dropdownIcon = '';
    private $activeClass = 'active';
    protected $activeItem = '';
    private $arrAttr = array();
    private $strAttr = array();
    private $arrData = array();
    private $result = array();

    public function __construct($options = array())
    {
        if (isset($options['data']))
        {
            $this->setData($options['data']);
        }
        $this->dropdownIcon = isset($options['dropdownIcon']) ? $options['dropdownIcon'] : $this->dropdownIcon;
        $this->activeClass = isset($options['active-class']) ? $options['active-class'] : $this->activeClass;
    }

    /**
     * Set the attributes for the tag vars
     * @param string $name Var name
     * @param mixed $value Var value
     * Var names: 'ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class'
     */
    public function set($name, $value)
    {
        $tags = array('ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class');
        if (in_array($name, $tags))
        {
            $this->arrAttr[$name] = $value;
        }
    }
    /**
     * Set dropdown icon for display with submenus
     * @param string $content Content for the dropdown icon (Html code)
     */
    public function setDropdownIcon($content)
    {
        $this->dropdownIcon = $content;
    }

    /**
     * @param string $href The active href
     * @param string $activeClass (Optional) The Css class for the active item
     */
    public function setActiveItem($href, $activeClass = '')
    {
        $this->activeItem = $href;
        if ($activeClass != '')
        {
            $this->activeClass = $activeClass;
        }
        $this->set('active-class', array('class' => $this->activeClass));
    }

    /**
     * @param mixed $data Data (Json string or associative array)
     */
    public function setData($data)
    {
        if (is_string($data))
        {
            $this->arrData = json_decode($data, TRUE);
        } elseif (is_array($data))
        {
            $this->arrData = $data;
        }
    }

    /**
     * Insert an item
     * @param array $item
     * @param string $before_at (Optional) The reference position for insert. The 'text' attribute
     * @param string $parent (Optional) The node parent if the insert is in a submenu. The 'text' attribute
     */
    public function insert($item, $before_at = '', $parent = '')
    {
        if ($before_at === '' && $parent === '')
        {
            $this->arrData[] = $item;
            return;
        }
        if ($parent === '')
        {
            $pos = array_search($before_at, array_column($this->arrData, 'text'));
            if ($pos !== FALSE)
            {
                array_splice($this->arrData, $pos, 0, array($item));
                return;
            }
            $this->arrData[] = $item;
        } else
        {
            $pos_parent = array_search($parent, array_column($this->arrData, 'text'));
            if ($pos_parent === FALSE)
            {
                $this->a8rrData[] = $item;
                return;
            }
            $pos = array_search($before_at, array_column($this->arrData[$pos_parent]['children'], 'text'));
            if ($pos !== FALSE)
            {
                array_splice($this->arrData[$pos_parent]['children'], $pos, 0, array($item));
                return;
            }
            $this->arrData[$pos_parent]['children'][] = $item;
        }
    }
    
    /**
     * Replace an item (find by text attribute)
     * @param array $newItem The new item
     * @param string $text The text item for search
     */
    public function replace(array $newItem, $text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        if ($pos===FALSE)
        {
            return FALSE;
        }
        $this->arrData[$pos] = $newItem;
        return TRUE;
    }
    
    /**
     * Remove an item (from top level) by text attribute
     * @param string $text Text item
     */
    public function remove($text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        if ($pos===FALSE)
        {
            return FALSE;
        }
        array_splice($this->arrData, $pos, 1);
        return TRUE;
    }
    /**
     * Get an menu item (from top level)
     * @param string $text Text menu to find
     * @return mixed Array with the item. Else not found, return NULL
     */
    public function getItem($text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        return ($pos!==FALSE) ? $this->arrData[$pos] : NULL;
    }
    
    /**
     * The Html menu
     * @return string Html menu
     */
    public function html()
    {
        if (!empty($this->result))
        {
            return $this->buildFromResult($this->result);
        }
        foreach ($this->arrAttr as $tag => $attr)
        {
            $this->strAttr[$tag] = $this->buildAttributes($tag);
        }
        return $this->build($this->arrData);
    }

    /**
     * Build the menu from query database.
     * This is a alias (shorthand) for setResult() and html()
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function fromResult($result, $columnID, $columnParent)
    {
        $this->setResult($result, $columnID, $columnParent);
        return $this->buildFromResult($this->result);
    }

    /**
     * Set result from query database
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function setResult($result, $columnID, $columnParent)
    {
        $items = array();
        foreach ($result as $row)
        {
            $target = (isset($row->target)) ? $row->target : '_self';
            $icon = (isset($row->icon)) ? $row->icon : '';
            $items[$row->$columnParent][$row->$columnID] = array('id' => $row->id, 'href' => $row->href, 'text' => $row->text, 'icon' => $icon, 'target' => $target);
        }
        $this->result = $items;
    }

    /**
     * @param string $tag
     * @return string Tag Attributes stored
     */
    protected function getAttr($tag)
    {
        return isset($this->strAttr[$tag]) ? $this->strAttr[$tag] : '';
    }

    /**
     * @param array $item The Item menu
     * @param boolean $isParent This item is parent?
     * @return string The Html code
     */
    protected function getTextItem($item, $isParent)
    {
        $str = (isset($item['icon'])) ? "<i class=\"{$item['icon']}\"></i> " : '';
        $str .= ($isParent) ? "{$item['text']} {$this->dropdownIcon}" : $item['text'];
        return $str;
    }

    /**
     * Renderize the tag attributes from array
     * @param string $tag The tag
     * @return string The string atributes
     */
    private function buildAttributes($tag)
    {
        $str = '';
        if (isset($this->arrAttr[$tag]))
        {
            foreach ($this->arrAttr[$tag] as $name => $value)
            {
                $str .= " {$name}=\"{$value}\"";
            }
        }
        return $str;
    }

    /**
     * Build the menu
     * @param array $array
     * @param int $depth (Optional)
     * @return string The Html code
     */
    protected function build($array, $depth = 0)
    {
        $str = ($depth === 0) ? '<ul' . $this->getAttr('ul-root') . '>' : '<ul' . $this->getAttr('ul') . '>';
        foreach ($array as $item)
        {
            $isParent = isset($item['children']);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
            $str .= '<li' . $this->getAttr($li) . " {$active} >";
            $str .= '<a href="' . $item['href'] . '" title="' . $item['title'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
            if ($isParent)
            {
                $str .= $this->build($item['children'], 1);
            }
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

    /**
     * Build the menu from a prepared array of Query Result
     * @param array $array Array de items
     * @param int $parent Parent ID
     * @param int $level Nivel del item
     */
    protected function buildFromResult(array $array, $parent = 0, $level = 0)
    {
        $ul = ($parent === 0) ? 'ul-root' : 'ul';
        $str = '<ul' . $this->getAttr($ul) . '>';
        foreach ($array[$parent] as $item_id => $item)
        {
            $isParent = isset($array[$item_id]);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            $str .= '<li' . $this->getAttr($li) . '>';
            $str .= "<a href=\"{$item['href']}\" target=\"{$item['target']}\"" . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
            if ($isParent)
            {
                $str .= $this->buildFromResult($array, $item_id, $level + 2);
            }
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
