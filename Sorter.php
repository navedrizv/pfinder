<?php


/**
 * Sorter class to sort an array input
 */
class Sorter {

	/**
	 * Object to hold the pass data
	 * @var array
	 */
	private $unsortedArray = array();
	
	/**
	 * Sorted list
	 * @var array
	 */
	private $sortedArray = array();

	/**
	 * Array to hold iternary
	 * @var array
	 */
	private $iternary = array();
	

	/**
	 *  Setter to load data into object
	 * @param array $input unsorted array
	 */
	public function setData($input = array())
	{
		try {

			if (!isset($input) && empty($input)) {
				throw new InvalidArgumentException('Input is not set');
			}

			if (!is_array($input)) {
				throw new InvalidArgumentException('Input is not an array');
			}

			$this->unsortedArray = $input;

		} catch (InvalidArgumentException $e) {
			throw $e;
		}
			
	}

	/**
	 * Getter
	 * @return array sorted array
	 */
	public function getData()
	{
		return $this->sortedArray;
	}

	/**
	 * Implementation of quick sort algorithm 
	 * @param  array $array Set of values to be sorted
	 * @param  array  $left  Array object to store values sorted to the left of pivot
	 * @param  array  $right Array object to store values sorted to the right of pivot
	 * @return void  
	 */
	public function qsort($left = array(), $right = array())
	{
		try {

			if (!is_array($left) && !is_array($right)) {
				throw  new InvalidArgumentException('Input parameter is not type Array');
			}

			if (!isset($this->unsortedArray) || empty($this->unsortedArray)) {
				throw  new Exception('Empty Input');
			}

			$length = count($this->unsortedArray);
			if ($length <= 1) {
				$this->sortedArray = $this->unsortedArray;
				return;
			}
			
			$pivotRight = $pivotLeft = $pivot = $this->unsortedArray[0];

			if (!empty($left)) {
				$pivotLeft =  $left[count($left) - 1];
			} 
		
			if (!empty($right)) {
				$pivotRight =  $right[count($right) - 1]; 
			} 

			for ($i = 1; $i < $length; $i++) {

				if (strtolower($pivotLeft['source']) == strtolower($this->unsortedArray[$i]['destination'])) {
					$left[] = $this->unsortedArray[$i];
				}

				if (strtolower($pivotRight['destination']) == strtolower($this->unsortedArray[$i]['source'])) {
					$right[] = $this->unsortedArray[$i];
				}
			}

			$this->sortedArray = array_merge(array_reverse($left), array($pivot),  $right);

			if (count($this->sortedArray) < $length) {
				return $this->qsort($left, $right);
			}
		} catch (Exception $e) {
			throw $e;
		}
	}


	/**
	 * Form iternary from sorted results
	 * @return array iternary object
	 */
	public function getIternary()
	{
		$iternary = array();
		try {

			$length = count($this->sortedArray);
			
			if ($length < 1) {
				throw new InvalidArgumentException ('Empty iternary');
			}

			for ($i = 0; $i < $length; $i++) {

				switch ($this->sortedArray[$i]['mode_of_transport']) {
					case 'flight':
						$iternary[] = 'Take flight# '.  $this->sortedArray[$i]['transport_details']['flight'] . ' from ' . $this->sortedArray[$i]['source'] . ' to ' . $this->sortedArray[$i]['destination'] . ' boarding at gate ' . $this->sortedArray[$i]['transport_details']['gate'] . ' you will be seated at seat# ' . $this->sortedArray[$i]['transport_details']['seat_no'];
						break;
					
					case 'train':
						$iternary[] = 'Take train# '.  $this->sortedArray[$i]['transport_details']['train'] . ' from ' . $this->sortedArray[$i]['source'] . ' to ' . $this->sortedArray[$i]['destination'] . ' boarding at platform ' . $this->sortedArray[$i]['transport_details']['platform'] . ' you will be seated at seat# ' . $this->sortedArray[$i]['transport_details']['seat_no'];
						break;
					
					case 'bus':
						$iternary[] = 'Take bus# '.  $this->sortedArray[$i]['transport_details']['bus'] . ' from ' . $this->sortedArray[$i]['source'] . ' to ' . $this->sortedArray[$i]['destination'] . ' you will be seated at seat# ' . $this->sortedArray[$i]['transport_details']['seat_no'];
						break;
					
					default:
						break;
				}
			}
			
			return $iternary;
		} catch (Exception $e) {
			throw $e;
		}
	}
}

