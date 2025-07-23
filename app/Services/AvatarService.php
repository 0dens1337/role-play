<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use InvalidArgumentException;

class AvatarService
{
    const int WIDTH = 300;
    const int HEIGHT = 300;

    public static function uploadAvatar($file): void
    {
        $user = auth()->user();
        $folder = 'avatars/user_' . $user->id;

        [$originalPath, $resizedPath] = self::processAndStore($file, $folder);

        $user->avatar = $originalPath;
        $user->save();
    }

    public static function uploadCharacterAvatar($file, $character): array
    {
        $folder = 'character/' . $character->id;

        Storage::disk('public')->deleteDirectory($folder);
        Storage::disk('public')->makeDirectory($folder);

        [$originalPath, $resizedPath] = self::processAndStore($file, $folder);

        return [
            'original_path' => $originalPath,
            'resized_path' => $resizedPath,
        ];
    }

    public static function uploadOrganizationAvatar($file, $organization): array
    {
        $folder = 'organization/' . $organization->id;

        Storage::disk('public')->deleteDirectory($folder);
        Storage::disk('public')->makeDirectory($folder);

        [$originalPath, $resizedPath] = self::processAndStore($file, $folder);

        return [
            'original_path' => $originalPath,
            'resized_path' => $resizedPath,
        ];
    }

    private static function processAndStore($file, string $folder): array
    {
        $extension = strtolower($file->getClientOriginalExtension());

        $originalPath = "$folder/original.$extension";
        $resizedPath = "$folder/resized.$extension";

        Storage::disk('public')->put($originalPath, file_get_contents($file));

        $absolutePath = Storage::disk('public')->path($originalPath);
        $resizedImage = ImageManager::imagick()->read($absolutePath);
        $resizedImage->resize(self::WIDTH, self::HEIGHT);

        $encoded = match ($extension) {
            'jpg', 'jpeg' => $resizedImage->toJpeg(),
            'png' => $resizedImage->toPng(),
            'webp' => $resizedImage->toWebp(),
            default => throw new InvalidArgumentException("Unsupported extension: $extension"),
        };

        Storage::disk('public')->put($resizedPath, (string) $encoded);

        return [$originalPath, $resizedPath];
    }
}
