<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(303) 555-0100',
            ]
        );
        $admin->syncRoles(['admin']);

        User::query()->updateOrCreate(
            ['email' => 'manager@peakframe.example'],
            [
                'name' => 'Jordan Hale',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(303) 555-0101',
            ]
        )->syncRoles(['manager']);

        User::query()->updateOrCreate(
            ['email' => 'yard@peakframe.example'],
            [
                'name' => 'Casey Ruiz',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(303) 555-0102',
            ]
        )->syncRoles(['staff']);

        $settings = [
            'company_name' => 'PeakFrame Scaffold Rentals',
            'company_phone' => '(303) 555-0184',
            'company_email' => 'hello@peakframe.example',
            'whatsapp' => '13035550184',
            'service_area' => 'Denver & Front Range, CO',
            'tax_rate' => '8.31',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => '5\' Walk-Through Frame', 'sku' => 'FRM-WT-5', 'category' => 'frame', 'unit_cost' => 28, 'unit_price' => 12, 'stock_qty' => 420, 'unit' => 'week'],
            ['name' => '6\'4" Masonry Frame', 'sku' => 'FRM-MAS-64', 'category' => 'frame', 'unit_cost' => 32, 'unit_price' => 14, 'stock_qty' => 310, 'unit' => 'week'],
            ['name' => 'Cross Brace Pair', 'sku' => 'FRM-XB', 'category' => 'frame', 'unit_cost' => 9, 'unit_price' => 4, 'stock_qty' => 800, 'unit' => 'week'],
            ['name' => '2x10 Scaffold Plank 16\'', 'sku' => 'PLK-16', 'category' => 'decking', 'unit_cost' => 22, 'unit_price' => 9, 'stock_qty' => 560, 'unit' => 'week'],
            ['name' => 'Aluminum Deck 7\'', 'sku' => 'PLK-AL-7', 'category' => 'decking', 'unit_cost' => 48, 'unit_price' => 18, 'stock_qty' => 180, 'unit' => 'week'],
            ['name' => 'Ring-Lock Ledger 8\'', 'sku' => 'SYS-LED-8', 'category' => 'system', 'unit_cost' => 35, 'unit_price' => 15, 'stock_qty' => 240, 'unit' => 'week'],
            ['name' => 'Baker Scaffold Complete', 'sku' => 'ROL-BAKER', 'category' => 'rolling', 'unit_cost' => 110, 'unit_price' => 45, 'stock_qty' => 64, 'unit' => 'week'],
            ['name' => 'Erect / Dismantle Crew Day', 'sku' => 'SVC-ERECT', 'category' => 'service', 'unit_cost' => 480, 'unit_price' => 980, 'stock_qty' => 999, 'unit' => 'day'],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['sku' => $product['sku']],
                $product + ['description' => $product['name'].' for scaffolding rental jobs.', 'is_active' => true]
            );
        }

        $customers = collect([
            ['name' => 'Summit Masonry Co.', 'email' => 'ops@summitmasonry.example', 'phone' => '(303) 555-2211', 'company' => 'Summit Masonry', 'city' => 'Denver', 'state' => 'CO', 'zip' => '80202', 'address' => '1400 Blake St'],
            ['name' => 'Front Range Facades LLC', 'email' => 'bids@frontrangefacades.example', 'phone' => '(303) 555-7788', 'company' => 'Front Range Facades', 'city' => 'Aurora', 'state' => 'CO', 'zip' => '80012', 'address' => '88 Havana St'],
            ['name' => 'Elena Vargas', 'email' => 'elena@example.com', 'phone' => '(303) 555-0199', 'company' => 'Vargas Painting', 'city' => 'Boulder', 'state' => 'CO', 'zip' => '80302', 'address' => '19 Pearl St'],
            ['name' => 'Mile High GC', 'email' => 'pm@milehighgc.example', 'phone' => '(303) 555-4410', 'company' => 'Mile High GC', 'city' => 'Denver', 'state' => 'CO', 'zip' => '80204', 'address' => '1200 Speer Blvd'],
            ['name' => 'Noah Patel', 'email' => 'noah.patel@example.com', 'phone' => '(719) 555-6622', 'company' => 'Patel Interiors', 'city' => 'Colorado Springs', 'state' => 'CO', 'zip' => '80903', 'address' => '77 Tejon St'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projects = [
            ['customer' => 0, 'title' => 'Frame package — Blake St façade', 'service_type' => 'frame', 'status' => 'scheduled', 'sq_ft' => 4200, 'quoted_amount' => 4850],
            ['customer' => 1, 'title' => 'System scaffold — Aurora mid-rise', 'service_type' => 'system', 'status' => 'in_progress', 'sq_ft' => 9800, 'quoted_amount' => 18200],
            ['customer' => 2, 'title' => 'Baker towers — Pearl St TI', 'service_type' => 'rolling', 'status' => 'quoted', 'sq_ft' => 1200, 'quoted_amount' => 960],
            ['customer' => 3, 'title' => 'Swing stage — Speer Blvd glass', 'service_type' => 'suspended', 'status' => 'completed', 'sq_ft' => 6400, 'quoted_amount' => 12400, 'final_amount' => 12400],
            ['customer' => 4, 'title' => 'Shoring + erect — Tejon pour', 'service_type' => 'shoring', 'status' => 'invoiced', 'sq_ft' => 2100, 'quoted_amount' => 6720, 'final_amount' => 6720],
        ];

        $projectModels = [];
        foreach ($projects as $i => $p) {
            $customer = $customers[$p['customer']];
            $projectModels[] = Project::query()->updateOrCreate(
                ['job_number' => 'PF-26'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'title' => $p['title'],
                    'service_type' => $p['service_type'],
                    'status' => $p['status'],
                    'sq_ft' => $p['sq_ft'],
                    'quoted_amount' => $p['quoted_amount'],
                    'final_amount' => $p['final_amount'] ?? null,
                    'start_date' => now()->subDays(10 - $i)->toDateString(),
                    'site_address' => trim(($customer->address ?? '').', '.$customer->city.', '.$customer->state),
                    'notes' => 'Seeded demo job for PeakFrame Scaffold Rentals ERP.',
                    'created_at' => now()->subMonths(5 - ($i % 6))->addDays($i),
                ]
            );
        }

        foreach ([0, 1, 3, 4] as $idx) {
            $project = $projectModels[$idx];
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-PF'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(8 - $idx)->toDateString(),
                    'due_date' => now()->addDays(14)->toDateString(),
                    'subtotal' => $project->final_amount ?? $project->quoted_amount,
                    'tax' => round(($project->final_amount ?? $project->quoted_amount) * 0.0831, 2),
                    'total' => round(($project->final_amount ?? $project->quoted_amount) * 1.0831, 2),
                    'amount_paid' => in_array($project->status, ['completed', 'invoiced'], true) ? round(($project->final_amount ?? $project->quoted_amount) * 1.0831, 2) : 0,
                    'status' => in_array($project->status, ['completed', 'invoiced'], true) ? 'paid' : 'sent',
                ]
            );

            if ($invoice->status === 'paid') {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->total,
                        'paid_at' => now()->subDays(3)->toDateString(),
                        'method' => 'ach',
                        'notes' => 'Demo payment',
                    ]
                );
            }
        }

        Appointment::query()->updateOrCreate(
            ['title' => 'Delivery — Summit Masonry Blake St'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projectModels[0]->id,
                'type' => 'delivery',
                'starts_at' => now()->addDays(2)->setTime(7, 0),
                'ends_at' => now()->addDays(2)->setTime(10, 0),
                'status' => 'scheduled',
                'location' => $customers[0]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'Erect — Front Range Facades Aurora'],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projectModels[1]->id,
                'type' => 'erect',
                'starts_at' => now()->addDays(5)->setTime(6, 30),
                'ends_at' => now()->addDays(5)->setTime(16, 0),
                'status' => 'confirmed',
                'location' => $customers[1]->address,
            ]
        );

        $posts = [
            [
                'title' => 'Frame vs system scaffolding for Front Range façades',
                'excerpt' => 'When straight masonry bays are enough — and when ring-lock geometry saves labor.',
                'cover' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1400&q=80',
                'body' => "Frame scaffolding wins on cost for rectangular façades. System scaffolding shines when ledgers must step around projections, atriums, or plant equipment.\n\nShare elevation drawings early so PeakFrame can pick the right fleet and avoid mid-job change orders on Denver sites.",
            ],
            [
                'title' => 'How to prepare a site for scaffold delivery',
                'excerpt' => 'Clear staging, curb permits, and ground bearing — before the flatbed arrives.',
                'cover' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1400&q=80',
                'body' => "Flag the unload zone, confirm curb or alley permits, and mark soft soils that need mudsills. Have a site contact ready for bay layout questions.\n\nGood prep cuts erect time and keeps your rental clock from starting while trucks wait.",
            ],
            [
                'title' => 'Guardrails, toeboards, and shift inspections',
                'excerpt' => 'OSHA-minded decking habits that keep elevated work moving without stop-work orders.',
                'cover' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1400&q=80',
                'body' => "Platforms need complete guardrail systems where required, and a competent person should inspect before each shift. Document wind events and after storms.\n\nPeakFrame tags gear at the yard; your crew owns daily checks once the scaffold is live.",
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 20)),
                ]
            );
        }

        $articles = [
            ['category' => 'issues', 'title' => 'Scaffold leaning after a wind event', 'body' => "1. Stop work and keep crews off the structure.\n2. Have a competent person inspect base plates, ties, and braces.\n3. Re-plumb and re-tie before releasing the platform.\n4. Log the inspection on the job record."],
            ['category' => 'issues', 'title' => 'Missing or damaged planks on return', 'body' => "Count planks against the delivery ticket before signing. Damaged decking is billed as damage. Stage returns on dunnage and protect plank ends during transport."],
            ['category' => 'guides', 'title' => 'How to request a PeakFrame quote', 'body' => "Send elevations or photos, note height and bay count, choose frame vs system, and say whether you need erect labor. We quote weekly/monthly rates plus delivery from the Denver yard."],
            ['category' => 'guides', 'title' => 'Choosing baker vs rolling tower kits', 'body' => "Baker scaffolds suit narrow corridors and paint. Wider rolling towers with outriggers fit warehouses and gyms. Confirm ceiling height and caster locks before ordering."],
            ['category' => 'admin', 'title' => 'Admin ERP quick start', 'body' => "Login at /admin with admin@example.com / password.\n1. Add contractors in CRM.\n2. Create a Job/Project with scaffold type and quote.\n3. Schedule delivery/erect appointments.\n4. Convert completed rentals to invoices and record payments.\n5. Use AI Studio for blog drafts and troubleshooting.\n6. Update company Settings for phone, WhatsApp, and tax rate."],
            ['category' => 'admin', 'title' => 'Roles: Admin, Manager, Staff', 'body' => "Admin: full ERP + settings + users.\nManager: jobs, inventory, invoices, scheduling.\nStaff: yard-facing records and appointment updates.\nAssign roles on the Users resource."],
            ['category' => 'troubleshoot', 'title' => 'Rental running over quoted weeks', 'body' => "Confirm on-rent vs off-rent dates. Extend the job in ERP, issue a change-order invoice for extra weeks, and update inventory availability."],
            ['category' => 'troubleshoot', 'title' => 'Chatbot giving demo answers only', 'body' => "Demo mode is expected without API keys. Add OPENAI_API_KEY or GEMINI_API_KEY to .env, then clear config cache. The public chatbot and AI Studio will prefer live models when keys are present."],
        ];
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'is_published' => true,
                ]
            );
        }
    }
}
