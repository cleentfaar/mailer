<?php

namespace CL\Mailer\Tests\Message\Attachment;

use CL\Mailer\Message\Attachment\FileAttachment;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\File\File;
use Vfs\FileSystem;
use Vfs\Node\Directory as VirtualDirectory;
use Vfs\Node\File as VirtualFile;

class FileAttachmentTest extends TestCase
{
    const FILE_NAME = 'foobar.txt';
    const FILE_CONTENT = 'Hello, World!';
    const DIR_NAME = 'mydir';

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
    public function it_returns_the_files_content_as_data()
    {
        // Create and mount the virtual file system
        $dir = new VirtualDirectory([self::FILE_NAME => new VirtualFile(self::FILE_CONTENT)]);
        $fileSystem = FileSystem::factory('vfs://');
        $fileSystem->mount();
        $root = $fileSystem->get('/');
        $root->add(self::DIR_NAME, $dir);

        $this->file->getRealPath()->willReturn('vfs://'.self::DIR_NAME.'/'.self::FILE_NAME);

        $this->assertSame(self::FILE_CONTENT, $this->attachment->getData());
    }

    /**
     * @test
     */
    public function it_returns_the_files_mimetype_as_content_type()
    {
        $this->file->getMimeType()->willReturn($mimeType = 'foo/bar');

        $this->assertSame($mimeType, $this->attachment->getContentType());
    }
}