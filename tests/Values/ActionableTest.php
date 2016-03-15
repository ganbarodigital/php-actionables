<?php

/**
 * Copyright (c) 2016-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Libraries
 * @package   Actionables/Values
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-data-containers
 */

namespace GanbaroDigitalTest\Actionables\Values;

use GanbaroDigital\Actionables\Values\Actionable;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\Actionables\Values\Actionable
 */
class ActionableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new Actionable($callable, $sourceFilename);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(Actionable::class, $unit);
    }

    /**
     * @covers ::__invoke
     */
    public function testCanInvoke()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function($param1, $param2){
            return [ $param1, $param2 ];
        };
        $sourceFilename = __FILE__;
        $unit = new Actionable($callable, $sourceFilename);

        $expectedResult = [ 100, 3.1415927 ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit($expectedResult);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getSourceFilename
     */
    public function testCanGetSourceFilename()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;
        $unit = new Actionable($callable, $sourceFilename);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getSourceFilename();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($sourceFilename, $actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::getTags
     */
    public function testHasNoTagsByDefault()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;
        $unit = new Actionable($callable, $sourceFilename);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getTags();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals([], $actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::getTags
     */
    public function testCanProvideAListOfTags()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;
        $tags = [
            'tag1',
            'tag2'
        ];
        $unit = new Actionable($callable, $sourceFilename, $tags);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->getTags();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($tags, $actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::hasTag
     */
    public function testCanCheckIfTagged()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;
        $tags = [
            'tag1',
            'tag2'
        ];
        $unit = new Actionable($callable, $sourceFilename, $tags);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->hasTag('tag1');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::__construct
     * @covers ::hasTag
     */
    public function testCanCheckIfNotTagged()
    {
        // ----------------------------------------------------------------
        // setup your test

        $callable = function(){};
        $sourceFilename = __FILE__;
        $tags = [
            'tag1',
            'tag2'
        ];
        $unit = new Actionable($callable, $sourceFilename, $tags);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->hasTag('tag3');

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

}
