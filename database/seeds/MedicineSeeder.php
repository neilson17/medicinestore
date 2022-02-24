<?php

use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category 1
        DB::table('medicines')->insert([
            'generic_name' => 'fentanil',
            'form' => 'inj 0,05 mg/mL (i.m./i.v.)',
            'restriction_formula' => '5 amp/kasus.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 1
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'fentanil',
            'form' => 'patch 12,5 mcg/jam',
            'restriction_formula' => '10 patch/bulan.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 1
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'kodein',
            'form' => 'tab 10 mg',
            'restriction_formula' => '30 tab/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 1
        ]);

        // Category 2
        DB::table('medicines')->insert([
            'generic_name' => 'asam mefenamat',
            'form' => 'kaps 250 mg',
            'restriction_formula' => '30 kaps/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 2
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'ibuprofen*',
            'form' => 'susp 100 mg/5 mL',
            'restriction_formula' => '1 btl/kasus.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 2
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'parasetamol',
            'form' => 'inf 10 mg/mL',
            'restriction_formula' => '3 btl/kasus.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 0,
            'faskes_tk3' => 1,
            'category_id' => 2
        ]);

        // Category 3
        DB::table('medicines')->insert([
            'generic_name' => 'alopurinol',
            'form' => 'tab 100 mg*',
            'restriction_formula' => '30 tab/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 3
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'alopurinol',
            'form' => 'tab 300 mg',
            'restriction_formula' => '30 tab/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 3
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'kolkisin',
            'form' => 'tab 500 mcg',
            'restriction_formula' => '30 tab/bulan',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 3
        ]);

        // Category 4
        DB::table('medicines')->insert([
            'generic_name' => 'amitriptilin',
            'form' => 'tab 25 mg',
            'restriction_formula' => '30 tab/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 4
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'gabapentin',
            'form' => 'kaps 100 mg',
            'restriction_formula' => '60 kaps/bulan.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 4
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'karbamazepin',
            'form' => 'tab 100 mg',
            'restriction_formula' => '60 tab/bulan.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 4
        ]);

        // Category 5
        DB::table('medicines')->insert([
            'generic_name' => 'etil klorida',
            'form' => 'spray 100 mL',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 5
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'bupivakain',
            'form' => 'inj 0,5%',
            'restriction_formula' => '',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 5
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'lidokain',
            'form' => 'inj 2%',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 5
        ]);

        // Category 6
        DB::table('medicines')->insert([
            'generic_name' => 'deksmedetomidin',
            'form' => 'inj 100 mcg/mL',
            'restriction_formula' => '',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 6
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'desfluran',
            'form' => 'ih',
            'restriction_formula' => '',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 6
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'oksigen',
            'form' => 'ih, gas dalam tabung',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 6
        ]);

        // Category 7
        DB::table('medicines')->insert([
            'generic_name' => 'atropin',
            'form' => 'inj 0,25 mg/mL (i.v./s.k.)',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 7
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'diazepam',
            'form' => 'inj 5 mg/mL',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 7
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'midazolam',
            'form' => 'inj 1 mg/mL (i.v.)',
            'restriction_formula' => '- Dosis rumatan: 1 mg/jam (24 mg/hari). - Dosis premedikasi: 8 vial/kasus',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 7
        ]);

        // Category 8
        DB::table('medicines')->insert([
            'generic_name' => 'deksametason',
            'form' => 'inj 5 mg/mL',
            'restriction_formula' => '20 mg/hari.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 8
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'difenhidramin',
            'form' => 'inj 10 mg/mL (i.v./i.m.)',
            'restriction_formula' => '30 mg/hari.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 8
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'klorfeniramin',
            'form' => 'tab 4 mg ',
            'restriction_formula' => '3 tab/hari, maks 5 hari.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 8
        ]);

        // Category 9
        DB::table('medicines')->insert([
            'generic_name' => 'diazepam',
            'form' => 'enema 5 mg/2,5 mL',
            'restriction_formula' => '2 tube/hari, bila kejang.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 9
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'fenitoin',
            'form' => 'kaps 30 mg*',
            'restriction_formula' => '90 kaps/bulan.',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 9
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'klonazepam',
            'form' => 'tab 2 mg',
            'restriction_formula' => '30 tab/bulan.',
            'faskes_tk1' => 0,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 9
        ]);

        // Category 10
        DB::table('medicines')->insert([
            'generic_name' => 'mebendazol',
            'form' => 'tab 400 mg',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 10
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'albendazol',
            'form' => 'tab 400 mg',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 10
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'prazikuantel',
            'form' => 'tab 600 mg',
            'restriction_formula' => '',
            'faskes_tk1' => 1,
            'faskes_tk2' => 1,
            'faskes_tk3' => 1,
            'category_id' => 10
        ]);
    }
}
