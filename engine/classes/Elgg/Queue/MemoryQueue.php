<?php

namespace Elgg\Queue;

/**
 * FIFO queue that is memory based (not persistent)
 *
 * WARNING: API IN FLUX. DO NOT USE DIRECTLY.
 *
 * @access private
 *        
 * @package Elgg.Core
 * @subpackage Queue
 * @since 1.9.0
 */
class MemoryQueue implements \Elgg\Queue\Queue {
	protected $queue = array ();
	
	/**
	 * Create a queue
	 */
	public function __construct() {
		$this->queue = array ();
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function enqueue($item) {
		return ( bool ) array_push ( $this->queue, $item );
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function dequeue() {
		return array_shift ( $this->queue );
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function clear() {
		$this->queue = array ();
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function size() {
		return count ( $this->queue );
	}
}

