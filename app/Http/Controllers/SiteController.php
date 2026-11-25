<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function services(): View
    {
        return view('pages.services', ['services' => $this->serviceCatalog()]);
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! PeakFrame Scaffold Rentals will follow up within one business day.');
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('category')->orderBy('title')->get()->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'session_id' => ['nullable', 'string', 'max:80'],
        ]);

        $result = $ai->chat($data['message'], $data['session_id'] ?? null);

        return response()->json($result);
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return [
            'frame-scaffolding' => [
                'title' => 'Frame Scaffolding Rental',
                'summary' => 'Tube & coupler frames, cross braces, and wood or aluminum planks for façades and masonry.',
                'body' => 'PeakFrame stocks walk-through and masonry frames in common bay lengths for Denver exterior work. We stage braces, base plates, and screw jacks with every pull, and our competent person can erect or supervise your crew. Weekly and monthly rental rates scale with height and plank count.',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80',
            ],
            'system-scaffolding' => [
                'title' => 'System / Modular Scaffolding',
                'summary' => 'Ring-lock and cup-lock systems for irregular footprints, atriums, and industrial plants.',
                'body' => 'When frame towers cannot follow the building geometry, system scaffolding keeps ledger levels consistent and load paths clear. We engineer bay layouts from your drawings, deliver labeled bundles, and erect multi-lift systems with stair towers and loading bays for Front Range commercial jobs.',
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1600&q=80',
            ],
            'rolling-towers' => [
                'title' => 'Rolling Towers & Baker Scaffolds',
                'summary' => 'Interior rolling towers and baker scaffolds for paint, MEP, and light exterior access.',
                'body' => 'Baker scaffolds and rolling towers move with your crew through corridors, warehouses, and gymnasiums. We rent complete kits with outriggers, locking casters, and guardrail packages. Ideal for Denver tenant-improvement and retail remodel schedules.',
                'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1600&q=80',
            ],
            'swing-stage' => [
                'title' => 'Swing Stage / Suspended Scaffold',
                'summary' => 'Two-point suspended platforms for window work, façade repair, and high-rise maintenance.',
                'body' => 'Suspended scaffolds need engineered tie-backs, counterweights, and hoist inspections. PeakFrame supplies platforms, motors, wire rope, and certified operators for swing-stage scopes on mid- and high-rise buildings along the Front Range.',
                'image' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1600&q=80',
            ],
            'shoring-support' => [
                'title' => 'Shoring & Formwork Support',
                'summary' => 'Post shores, beams, and temporary support for pours and structural renovations.',
                'body' => 'Temporary shoring protects openings during demo and supports formwork for elevated slabs. We stock adjustable posts, stringers, and bracing packages sized from your structural notes — delivered with clear load charts for the GC.',
                'image' => 'https://images.unsplash.com/photo-1590644365607-1c5ac295ecdc?auto=format&fit=crop&w=1600&q=80',
            ],
            'delivery-erect' => [
                'title' => 'Delivery, Erect & Dismantle',
                'summary' => 'Yard pulls, flatbed delivery, certified erection, and tear-down with return inspection.',
                'body' => 'Our logistics desk schedules trucks from the Denver yard, stages equipment by lift, and dispatches competent-person crews for erect and dismantle. After return, every frame and plank is inspected before restocking — damage is documented against the rental job in the ERP.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
