<?php

namespace Elgg\Http;

/**
 * Based on Symfony2's NativeSessionStorage.
 *
 * Copyright (c) 2004-2013 Fabien Potencier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Mock for unit tests.
 *
 * @access private
 *        
 * @package Elgg.Core
 * @subpackage Http
 */
class MockSessionStorage implements \Elgg\Http\SessionStorage {
	
	/**
	 * @var boolean
	 */
	protected $started = false;
	
	/**
	 * @var boolean
	 */
	protected $closed = false;
	
	/**
	 * @var string
	 */
	protected $id = '';
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var array
	 */
	protected $data = array ();
	
	/**
	 * Constructor.
	 *
	 * @param string $name
	 *        	Session name
	 */
	public function __construct($name = 'MOCKSESSID') {
		$this->name = $name;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function start() {
		if ($this->started && ! $this->closed) {
			return true;
		}
		
		if (empty ( $this->id )) {
			$this->id = $this->generateId ();
		}
		
		$this->started = true;
		$this->closed = false;
		
		return true;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function regenerate($destroy = false, $lifetime = null) {
		if (! $this->started) {
			$this->start ();
		}
		
		$this->id = $this->generateId ();
		
		return true;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function save() {
		if (! $this->started || $this->closed) {
			throw new \RuntimeException ( "Trying to save a session that was not started yet or was already closed" );
		}
		$this->closed = false;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function isStarted() {
		return $this->started;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function setId($id) {
		if ($this->started) {
			throw new \RuntimeException ( 'Cannot change the ID of an active session' );
		}
		
		$this->id = $id;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Generates a session ID.
	 *
	 * This doesn't need to be particularly cryptographically secure since this is just
	 * a mock.
	 *
	 * @return string
	 */
	protected function generateId() {
		return sha1 ( uniqid ( mt_rand () ) );
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function has($name) {
		if (! $this->started) {
			$this->start ();
		}
		return array_key_exists ( $name, $this->data );
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function get($name, $default = null) {
		if (! $this->started) {
			$this->start ();
		}
		return array_key_exists ( $name, $this->data ) ? $this->data [$name] : $default;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function set($name, $value) {
		if (! $this->started) {
			$this->start ();
		}
		$this->data [$name] = $value;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function all() {
		if (! $this->started) {
			$this->start ();
		}
		return $this->data;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function replace(array $attributes) {
		if (! $this->started) {
			$this->start ();
		}
		$this->data = array ();
		foreach ( $attributes as $key => $value ) {
			$this->set ( $key, $value );
		}
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function remove($name) {
		if (! $this->started) {
			$this->start ();
		}
		$retval = null;
		if (array_key_exists ( $name, $this->data )) {
			$retval = $this->data [$name];
			unset ( $this->data [$name] );
		}
		
		return $retval;
	}
	
	/**
	 *
	 * @ERROR!!!
	 *
	 */
	public function clear() {
		if (! $this->started) {
			$this->start ();
		}
		$this->data = array ();
	}
}

