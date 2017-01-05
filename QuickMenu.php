<?php
/**
 * Class Quick Menu
 * @author David Ticona Saravia <davicotico@gmail.com>
 * @version 0.5 (01/2017)
 */
class QuickMenu
{
	private $iconFamily = 'fa';
    private $dropdownIcon = '';
	private $properties = array();
	private $attr = array();
	private $array = array();
	
	public function __construct($options = array())
	{
		if (isset($options['data']))
		{
			$this->setData($options['data']);
		}
		$this->iconFamily = isset($options['iconFamily']) ? $options['iconFamily'] : $this->iconFamily;
        $this->dropdownIcon = isset($options['dropdownIcon']) ? $options['dropdownIcon'] : $this->dropdownIcon;
	}
	/**
	* @param mixed $data Data (Json string or associative array)
	*/
	public function setData($data)
	{
		if (is_string($data))
		{
			$this->array = json_decode($data, TRUE);
		} elseif (is_array($data))
		{
			$this->array = $data;
		}
	}
	/**
	* @param string $tag 
	* @param array $array
	*/
	public function setProperties($tag, $array)
	{
		$this->properties[$tag] = $array;
	}
	/**
	* Insert an item
	* @param array $item
	* @param string $before_at (Optional) Default = ''
	* @param string $parent (Optional) Default = ''
	*/
	public function insert($item, $before_at = '', $parent = '')
	{
		if ($before_at==='' && $parent==='')
		{
			$this->array[] = $item;
			return;
		}
		if ($parent==='')
		{
			$pos = array_search($before_at, array_column($this->array, 'text'));
			if ($pos!==FALSE)
			{
				array_splice($this->array, $pos, 0, array($item));
				return;
			}
			$this->array[] = $item;
		} else
		{
			$pos_parent = array_search($parent, array_column($this->array, 'text'));
			if ($pos_parent===FALSE)
			{
				$this->array[] = $item;
				return;
			}
			$pos = array_search($before_at, array_column($this->array[$pos_parent]['children'], 'text'));
			if ($pos!==FALSE)
			{
				array_splice($this->array[$pos_parent]['children'], $pos, 0, array($item));
				return;
			}
			$this->array[$pos_parent]['children'][]=$item;
		}
	}
	/**
	* 
	* @return string Html menu
	*/
	public function html()
	{
		foreach ($this->properties as $tag => $attr)
		{
			$this->attr[$tag] = $this->buildProperties($tag);
		}
		return $this->build($this->array);
	}
	public function view()
	{
		echo $this->html();
	}
	/**
	* @param string $tag
	* @return string Attributes
	*/
	private function buildProperties($tag)
	{
		$str = '';
		if (isset($this->properties[$tag]))
        {
            foreach ($this->properties[$tag] as $name=>$value)
            {
                $str .= " {$name}=\"{$value}\"";
            }
        }
        return $str;
	}
	/**
	* @param string $tag
	* @return string Attribute
	*/
	private function getProperties($tag)
	{
		return isset($this->attr[$tag]) ? $this->attr[$tag] : '';
	}
	/**
	* @param array $array
	* @param int $depth (Optional) Default: 0
	* @return string 
	*/
	private function build($array, $depth=0)
	{
		$str = ($depth===0) ? '<ul'.$this->getProperties('ul-root').'>' : '<ul'. $this->getProperties('ul').'>';
		foreach ($array as $item)
		{
            $isParent = isset($item['children']);
			$li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
			$str .= '<li'.$this->getProperties($li).'>';
            $str .= '<a href="'.$item['href'].'" title="'.$item['title'].'"'. $this->getProperties($a).'>'.$this->getText($item, $isParent).'</a>';
			if ($isParent)
			{
				$str .= $this->build($item['children'], 1);
			}
			$str .='</li>';
		}
		$str .='</ul>';
		return $str;
	}
    private function getText($item, $isParent)
    {
        $str = (isset($item['icon'])) ? "<i class=\"{$this->iconFamily} {$item['icon']}\"></i> " : '';
        if ($isParent)
        {
            $str = "{$item['text']} {$this->dropdownIcon}";
        } else
        {
            $str.= $item['text'];
        }
        return $str;
    }
}
