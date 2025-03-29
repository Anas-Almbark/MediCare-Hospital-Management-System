<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $message = $request->message;
            $isArabic = preg_match('/\p{Arabic}/u', $message);
            
            $systemMessage = $isArabic 
                ? 'أنت مساعد طبي مفيد. يرجى الرد باللغة العربية.'
                : 'You are a helpful medical assistant. Please respond in English.';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.together.xyz/v1/chat/completions', [
                'model' => 'mistralai/Mixtral-8x7B-Instruct-v0.1',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
                'max_tokens' => 800
            ]);

            if (!$response->successful()) {
                Log::error('Together API Error: ' . $response->body());
                throw new \Exception($isArabic ? 'فشل في الحصول على رد من API' : 'Failed to get response from API');
            }

            $responseData = $response->json();
            return response()->json([
                'response' => $responseData['choices'][0]['message']['content']
            ]);

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json([
                'error' => $isArabic ? 'عذراً، حدث خطأ. يرجى المحاولة مرة أخرى.' : 'Sorry, an error occurred. Please try again.'
            ], 500);
        }
    }
}