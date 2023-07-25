<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticated;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserUploadVideoTest extends TestCase
{
    private string $token = '';
    protected function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/login', [
            'email' => 'user@example.com',
            'password' => '123'
        ]);
        $this->token = $response->baseResponse->getOriginalContent()["data"]["token"];
    }

    public function test_file_upload_success()
    {
        // Create a mock file for testing
        $file = UploadedFile::fake()->create('test_video.mp4', 1000); // 1000 KB file size

        // Simulate the file upload request
        $response = $this->post('/api/upload', [
            'video' => $file,
            'title' => 'this is test video title',
            'description' => 'this is test video description'
        ],headers: [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        // Assert that the response is successful (HTTP status code 200)
        $response->assertStatus(200);

        // Assert that the file is stored in the expected location
        Storage::disk('public')->assertExists('videos/' . $file->hashName());

        // Assert that the success message is present in the response
        $response->assertSee('Video uploaded successfully');
    }

    public function test_file_upload_failure_invalid_file()
    {
        // Create an invalid file (mime type not allowed)
        $invalidFile = UploadedFile::fake()->create('test_invalid.docx', 1000); // 1000 KB file size

        // Simulate the file upload request
        $response = $this->post('/api/upload', [
            'video' => $invalidFile,
            'title' => 'this is test video title',
        ],headers: [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        // Assert that the response is not successful (HTTP status code 422 - Unprocessable Content)
        $response->assertStatus(422);

        // Assert that the file is not stored in the expected location
        Storage::disk('public')->assertMissing('videos/' . $invalidFile->hashName());
    }
}
