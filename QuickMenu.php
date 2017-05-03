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
            return;
        }
        if (property_exists($this, $name))
        {
            $this->$name = $value;
        }
    }
    /**
     * @param string $href The active href
     * @param string $activeClass (Optional) The Css class for the active item
     */
    public function setActiveItem($href, $activeClass = '')
    {
        $this->activeItem = $href;
        if ($activeClass!='')
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
    * @param string $before_at (Optional) The reference position for insert
    * @param string $parent (Optional) The parent if the insert is at a submenu
    */
    public function insert($item, $before_at = '', $parent = '')
    {
        if ($before_at==='' && $parent==='')
        {
            $this->arrData[] = $item;
            return;
        }
        if ($parent==='')
        {
            $pos = array_search($before_at, array_column($this->arrData, 'text'));
            if ($pos!==FALSE)
            {
                array_splice($this->arrData, $pos, 0, array($item));
                return;
            }
            $this->arrData[] = $item;
        } else
        {
            $pos_parent = array_search($parent, array_column($this->arrData, 'text'));
            if ($pos_parent===FALSE)
            {
                $this->arrData[] = $item;
                return;
            }
            $pos = array_search($before_at, array_column($this->arrData[$pos_parent]['children'], 'text'));
            if ($pos!==FALSE)
            {
                array_splice($this->arrData[$pos_parent]['children'], $pos, 0, array($item));
                return;
            }
            $this->arrData[$pos_parent]['children'][]=$item;
        }
    }
    /**
     * The Html menu
     * @return string Html menu
     */
    public function html()
    {
        foreach ($this->arrAttr as $tag => $attr)
        {
            $this->strAttr[$tag] = $this->buildAttributes($tag);
        }
        return $this->build($this->arrData);
    }
    
    /**
    * @param array $result Result from query (Object result)
    * @param string $idColumn ID field name
    * @param string $parentColumn Parent field name
    */
    public function fromResult($result, $idColumn, $parentColumn)
    {
        $items = array();
        foreach ($result as $row)
        {
            $target = (isset($row->target)) ? $row->target : '_self';
            $icon = (isset($row->icon)) ? $row->icon : '';
            $items[$row->$parentColumn][$row->$idColumn] = array('id'=>$row->id, 'href' => $row->href, 'text' => $row->text, 'icon'=>$icon, 'target'=>$target);
        }
        return $this->buildFromResult($items);
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
        $str.= ($isParent) ? "{$item['text']} {$this->dropdownIcon}" : $item['text'];
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
            foreach ($this->arrAttr[$tag] as $name=>$value)
            {
                $str .= " {$name}=\"{$value}\"";
            }
        }
        return $str;
    }
    
    /**
     * 
     * @param array $array
     * @param int $depth (Optional)
     * @return string The Html code
     */
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
    
    /**
     * Método recursivo para crear items desde un query result
     * @param array $array Array de items
     * @param int $parent Parent ID
     * @param int $level Nivel del item
     */
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
