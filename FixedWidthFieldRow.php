<?php
class FixedWidthField
{
	protected $width;
	protected $value;
	protected $align;
	protected $padding;
	
	public function __construct($width, $value, $align='L', $padding=' ')
	{
		settype($width, 'int');
		$this->width = $width;
		
		$this->value = (string)$value;
		if (strlen($value) > $width)
			throw new Exception('Value too wide for field');
			
		$this->align = $align;
		$this->padding = $padding;
	}
	
	public function __toString()
	{
		$format = '%';
		$format .= "'" . $this->padding;
		if ('L' == $this->align)
			$format .= '-';
		$format .= $this->width;
		$format .= 's';
		
		return sprintf($format, $this->value);
	}
}

class FixedWidthFieldRow
{
	protected $fields = array();
	
	public function addField(FixedWidthField $field)
	{
		$this->fields[] = $field;
	}
	
	public function __toString()
	{
		return implode('', $this->fields);
	}
}

class FixedWidthFieldFile
{
	protected $rows = array();
	
	public function addRow(FixedWidthFieldRow $row)
	{
		$this->rows[] = $row;
	}
	
	public function __toString()
	{
		return implode(PHP_EOL, $this->rows());
	}
}
