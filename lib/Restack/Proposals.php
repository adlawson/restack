<?php

namespace Restack;

/**
 * Proposed directory structure
 * 
 * Restack/
 *     Dependency/
 *         Provider.php
 *     Exception/
 *         CircularDependencyException.php
 *         InvalidItemException.php
 *     Exception.php
 *     Queue.php
 *     Stack.php
 *     StructureInterface.php
 */

/**
 * Notes:
 * Restack\Index could implement now with minor changes
 */
interface Queue extends \Countable
{
    public function count();
    public function pop();
    public function push( $value );
    public function shift();
    public function unshift( $value );
}

/**
 * Notes:
 * Could be merged with SuperQueue - I don't see the need to separate them
 */
interface AdvancedQueue extends Queue
{
    public function clear();
    public function filter( $callback );
    public function map( $callback, $userdata );
    public function remove( $value );
    public function replace( $value, $value2 );
    public function reverse();
    public function search( $value );
    public function values();
    public function walk( $callback, $userdata );
}

/**
 * Notes:
 * As noted above, maybe this should be merged with AdvancedQueue?
 */
interface SuperQueue extends AdvancedQueue
{
    public function diff( array $array1 );
    public function insertBefore( $value, $value2 );
    public function insertAfter( $value, $value2 );
    public function intersect( array $array1 );
    public function merge( array $array1 );
    public function removeRandom();
    public function shuffle();
    public function makeUnique();
}

/**
 * Notes:
 * 
 */
interface DoublyLinkedList extends Queue, Iterator, ArrayAccess
{
    public function getIteratorMode();
    public function setIteratorMode( $mode );
    public function isEmpty();
}

/**
 * Notes:
 * Could be a good addition with top(), bottom() and valid()
 * That said, I don't like implementing Iterator, much prefer IteratorAggregate
 * Crude benchmarks (@link http://www.garfieldtech.com/blog/magic-benchmarks)
 */
interface Iterator extends \Iterator, \Countable
{
    public function rewind();
    public function current();
    public function key();
    public function next();
    public function valid();
    public function count();
    public function bottom();
    public function top();
}

/**
 * Notes:
 * Still unsure about ArrayAccess but might be useful
 */
interface ArrayAccess extends \ArrayAccess
{
    public function offsetExists( $index );
    public function offsetGet( $index );
    public function offsetSet( $index, $value );
    public function offsetUnset( $index );
}

/**
 * Notes:
 * As noted above, I much prefer this than Iterator
 */
interface IteratorAggregate extends \IteratorAggregate
{
    public function getIterator();
    public function setIterator();
}