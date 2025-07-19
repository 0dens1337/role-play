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
        $extension = $file->getClientOriginalExtension();

        $folder = 'avatars/user_' . $user->id;
        $originalPath = "$folder/original.$extension";
        $resizedPath = "$folder/resized.$extension";

        Storage::disk('public')->put($originalPath, file_get_contents($file));

        $absolutePath = Storage::disk('public')->path($originalPath);
        $resizedImage = ImageManager::imagick()->read($absolutePath); // для винды поставить gd() вместо imagick()
        $resizedImage->resize(self::WIDTH, self::HEIGHT);

        $encoded = match (strtolower($extension)) {
            'jpg', 'jpeg' => $resizedImage->toJpeg(),
            'png' => $resizedImage->toPng(),
            'webp' => $resizedImage->toWebp(),
            default => throw new InvalidArgumentException("Не поддерживаемое разрешение: $extension"),
        };
        Storage::disk('public')->put($resizedPath, (string) $encoded);

        $user->avatar = $originalPath;
        $user->save();
    }
}
