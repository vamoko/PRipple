<?php
declare(strict_types=1);

namespace Cclilshy\PRipple\FileSystem\Standard;

interface File
{
    public const STP = PRIPPLE_PIPE_PATH;
    public const EXT = '.pipe';

    /**
     * @param string|null $name
     * @return false|static
     */
    public static function create(?string $name): self|false;


    /**
     * @param string|null $name
     * @return false|static
     */
    public static function link(?string $name): self|false;


    /**
     * @param string|null $name
     * @return bool
     */
    public static function exists(?string $name): bool;


    /**
     * @param string   $context
     * @param int|null $start
     * @return int|false
     */
    public function write(string $context, ?int $start = 0): int|false;


    /**
     * @param int $start
     * @param int $eof
     * @return string|false
     */
    public function section(int $start, int $eof): string|false;


    /**
     * @return bool
     */
    public function flush(): bool;


    /**
     * @return string|false
     */
    public function read(): string|false;


    /**
     * @return void
     */
    public function close(): void;


    /**
     * @return void
     */
    public function release(): void;

}