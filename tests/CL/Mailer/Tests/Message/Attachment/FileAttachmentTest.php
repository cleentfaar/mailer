<?php

namespace CL\Mailer\Tests\Message\Attachment;

use CL\Mailer\Message\Attachment\FileAttachment;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\File\File;

class FileAttachmentTest extends TestCase
{
    /**
     * @var ObjectProphecy|File
     */
    private $file;

    /**
     * @var FileAttachment
     */
    private $attachment;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->file = $this->prophesize(File::class);
        $this->attachment = new FileAttachment($this->file->reveal());
    }

    /**
     * @test
     */
    public function it_returns_the_files_realpath_as_a_location()
    {
        $this->file->getRealPath()->willReturn($realPath = '/path/to/attachment');

        $this->assertSame($realPath, $this->attachment->getLocation());
    }

    /**
     * @test
     */
    public function it_returns_the_files_mimetype()
    {
        $this->file->getMimeType()->willReturn($mimeType = 'foo/bar');

        $this->assertSame($mimeType, $this->attachment->getMimeType());
    }
}