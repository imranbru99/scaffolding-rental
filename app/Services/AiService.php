<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = [
        [
            'q' => 'price cost how much estimate quote rental rate',
            'a' => 'PeakFrame Scaffold Rentals quotes weekly and monthly rates by bay count, height, and plank type. Typical Denver frame packages start in the low hundreds per week for small façades; system and swing-stage scopes are engineered after drawings. Call (303) 555-0184 or send plans via the contact form.',
        ],
        [
            'q' => 'schedule delivery book erect when available',
            'a' => 'We deliver Mon–Sat from the Denver yard. Call (303) 555-0184, use the contact form, or WhatsApp us. Peak summer façade seasons fill early — request trucks for Aurora, Boulder, and Colorado Springs with at least a few days’ notice.',
        ],
        [
            'q' => 'frame vs system modular ring lock cup lock',
            'a' => 'Frame scaffolding suits straight façades and masonry. System (ring-lock / cup-lock) fits irregular footprints, atriums, and industrial plants where ledgers must step. Tell us your geometry and we’ll recommend the right fleet.',
        ],
        [
            'q' => 'osha guardrail toe board inspection competent person',
            'a' => 'Platforms need guardrails, midrails, and toeboards where required. A competent person should inspect before each shift. PeakFrame tags equipment at the yard and can provide erect crews who document inspections on the job.',
        ],
        [
            'q' => 'swing stage suspended hoist counterweight',
            'a' => 'Swing stages need engineered counterweights, tie-backs, and inspected hoists. We supply platforms, motors, and certified operators for high-rise façade and window work across the Front Range.',
        ],
        [
            'q' => 'rolling tower baker interior paint',
            'a' => 'Baker scaffolds and rolling towers are ideal for interiors and light exterior access. Kits include outriggers and locking casters. Great for tenant improvements and retail remodels in the Denver metro.',
        ],
        [
            'q' => 'damage missing plank return inspection deposit',
            'a' => 'Returned gear is inspected against the rental ticket. Bent frames, missing braces, and damaged planks are billed as damage. Keep count sheets and protect plank ends during transport to avoid charges.',
        ],
        [
            'q' => 'shoring formwork pour support load',
            'a' => 'We rent adjustable post shores and beams for temporary support and formwork. Provide structural notes or loads so we size posts correctly — never exceed published charts.',
        ],
    ];

    public function chat(string $message, ?string $sessionId = null): array
    {
        $reply = null;
        $source = 'demo';

        if ($key = config('services.openai.key')) {
            try {
                $reply = $this->callOpenAi($message, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply && ($gemini = config('services.gemini.key'))) {
            try {
                $reply = $this->callGemini($message, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply) {
            $reply = $this->demoReply($message);
            $source = 'demo';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'message' => $message,
            'reply' => $reply,
            'source' => $source,
        ]);

        return ['reply' => $reply, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $message = match ($type) {
            'blog' => "Write a concise SEO blog post outline and intro for a scaffolding rental company about: {$prompt}",
            'description' => "Write a compelling product/service description for scaffolding rental, erect, or shoring: {$prompt}",
            'automation' => "Suggest 5 practical AI automations for a scaffolding rental ERP related to: {$prompt}",
            'troubleshoot' => "Troubleshoot this scaffolding rental/operations issue with clear steps: {$prompt}",
            default => $prompt,
        };

        $result = $this->chat($message);

        return $result['reply'];
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $word) {
                if ($word !== '' && str_contains($hay, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best;
        }

        return 'Thanks for reaching PeakFrame Scaffold Rentals. We rent frame, system, rolling, and swing-stage scaffolds with delivery and erect across Denver and the Front Range. Ask about rates, OSHA decking, or booking — or call (303) 555-0184.';
    }

    protected function callOpenAi(string $message, string $key): string
    {
        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are the PeakFrame Scaffold Rentals assistant for a Denver, CO scaffolding rental SME (frame, system, rolling towers, swing stage, shoring, delivery/erect). Be concise and practical. Never invent illegal claims. Encourage competent-person inspections and OSHA-compliant guardrails.',
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.4,
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', 'Unable to generate a response.');
    }

    protected function callGemini(string $message, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "You are PeakFrame Scaffold Rentals assistant (Denver scaffolding rental/erect). Answer briefly:\n{$message}"],
                        ],
                    ],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', 'Unable to generate a response.');
    }
}
