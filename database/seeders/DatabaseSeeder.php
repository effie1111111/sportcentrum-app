<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Voorbeeldgegevens voor Sportcentrum De Linde.
     *
     * Veilig opnieuw uit te voeren: bestaande records worden opgezocht
     * en bijgewerkt in plaats van telkens opnieuw aangemaakt.
     */
    public function run(): void
    {
        /*
         * GEBRUIKERS
         *
         * De database bevat zowel 'rol' als 'role'.
         * Daarom vullen we beide kolommen.
         */
        $gebruikersData = [
            [
                'name' => 'Beheerder De Linde',
                'email' => 'beheerder@delinde.test',
                'telefoon' => '0612345678',
                'rol' => 'beheerder',
                'role' => 'admin',
            ],
            [
                'name' => 'Lisa Jansen',
                'email' => 'lisa.jansen@delinde.test',
                'telefoon' => '0611111111',
                'rol' => 'lid',
                'role' => 'begeleider',
            ],
            [
                'name' => 'Mark Bakker',
                'email' => 'mark.bakker@delinde.test',
                'telefoon' => '0622222222',
                'rol' => 'lid',
                'role' => 'begeleider',
            ],
            [
                'name' => 'Sam de Vries',
                'email' => 'sam@example.test',
                'telefoon' => '0633333333',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Noor Bakker',
                'email' => 'noor@example.test',
                'telefoon' => '0644444444',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Milan Jansen',
                'email' => 'milan@example.test',
                'telefoon' => '0655555555',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Sara Visser',
                'email' => 'sara@example.test',
                'telefoon' => '0666666666',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Luca Smit',
                'email' => 'luca@example.test',
                'telefoon' => '0677777777',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Emma Peters',
                'email' => 'emma@example.test',
                'telefoon' => '0688888888',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
            [
                'name' => 'Daan Meijer',
                'email' => 'daan@example.test',
                'telefoon' => '0699999999',
                'rol' => 'lid',
                'role' => 'gebruiker',
            ],
        ];

        $gebruikers = collect($gebruikersData)->mapWithKeys(function (array $data) {
            DB::table('users')->updateOrInsert(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'telefoon' => $data['telefoon'],
                    'rol' => $data['rol'],
                    'role' => $data['role'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            return [$data['email'] => DB::table('users')
                ->where('email', $data['email'])
                ->value('id')];
        });

        $beheerderId = $gebruikers['beheerder@delinde.test'];
        $begeleiderLisaId = $gebruikers['lisa.jansen@delinde.test'];
        $begeleiderMarkId = $gebruikers['mark.bakker@delinde.test'];

        $leden = collect([
            $gebruikers['sam@example.test'],
            $gebruikers['noor@example.test'],
            $gebruikers['milan@example.test'],
            $gebruikers['sara@example.test'],
            $gebruikers['luca@example.test'],
            $gebruikers['emma@example.test'],
            $gebruikers['daan@example.test'],
        ]);

        /*
         * STATUSSEN VOOR HET OUDE RESERVERINGSSYSTEEM
         */
        $statusIds = collect([
            'Bevestigd',
            'Geannuleerd',
            'Wachtlijst',
        ])->mapWithKeys(function (string $naam) {
            DB::table('status')->updateOrInsert(
                ['name' => $naam],
                []
            );

            return [$naam => DB::table('status')
                ->where('name', $naam)
                ->value('id')];
        });

        /*
         * ACTIVITEITEN
         */
        $activiteitenData = [
            ['naam' => 'Spinning', 'beschrijving' => 'Energieke indoor cyclingles.'],
            ['naam' => 'Yoga', 'beschrijving' => 'Rustige les met aandacht voor houding en ademhaling.'],
            ['naam' => 'Aquagym', 'beschrijving' => 'Bewegen en trainen in het zwembad.'],
        ];

        $activiteiten = collect($activiteitenData)->mapWithKeys(function (array $activiteit) use ($beheerderId) {
            DB::table('activiteiten')->updateOrInsert(
                [
                    'naam' => $activiteit['naam'],
                    'gebruiker_id' => $beheerderId,
                ],
                $activiteit + [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            return [$activiteit['naam'] => DB::table('activiteiten')
                ->where('naam', $activiteit['naam'])
                ->where('gebruiker_id', $beheerderId)
                ->value('id')];
        });

        /*
         * LESMOMENTEN VOOR HET OUDE RESERVERINGSSYSTEEM
         */
        $lesmomentData = [
            ['activiteit' => 'Spinning', 'dag' => 1, 'start' => '18:00', 'duur' => 60, 'capaciteit' => 16],
            ['activiteit' => 'Yoga', 'dag' => 2, 'start' => '19:00', 'duur' => 60, 'capaciteit' => 12],
            ['activiteit' => 'Aquagym', 'dag' => 3, 'start' => '10:00', 'duur' => 45, 'capaciteit' => 20],
        ];

        $lesmomenten = collect($lesmomentData)->mapWithKeys(function (array $les) use ($activiteiten) {
            $start = now()->startOfWeek()->addDays($les['dag'])->setTimeFromTimeString($les['start']);
            $eind = $start->copy()->addMinutes($les['duur']);

            DB::table('lesmomenten')->updateOrInsert(
                [
                    'activiteit_id' => $activiteiten[$les['activiteit']],
                    'start_tijd' => $start->toDateTimeString(),
                ],
                [
                    'eind_tijd' => $eind->toDateTimeString(),
                    'max_deelnemers' => $les['capaciteit'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            return [$les['activiteit'] => DB::table('lesmomenten')
                ->where('activiteit_id', $activiteiten[$les['activiteit']])
                ->where('start_tijd', $start->toDateTimeString())
                ->value('id')];
        });

        /*
         * RESERVERINGEN
         *
         * Verschillende leden krijgen verschillende activiteiten.
         */
        foreach ($leden as $index => $lidId) {
            $lesId = $lesmomenten->values()[$index % $lesmomenten->count()];

            DB::table('reserveringen')->updateOrInsert(
                [
                    'gebruiker_id' => $lidId,
                    'lesmoment_id' => $lesId,
                ],
                [
                    'status_id' => $statusIds['Bevestigd'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Voorbeeld van een geannuleerde reservering.
        DB::table('reserveringen')->updateOrInsert(
            [
                'gebruiker_id' => $leden[0],
                'lesmoment_id' => $lesmomenten['Aquagym'],
            ],
            [
                'status_id' => $statusIds['Geannuleerd'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
         * WACHTLIJST
         */
        DB::table('wachtlijst')->updateOrInsert(
            [
                'gebruiker_id' => $leden[4],
                'lesmoment_id' => $lesmomenten['Spinning'],
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('wachtlijst')->updateOrInsert(
            [
                'gebruiker_id' => $leden[5],
                'lesmoment_id' => $lesmomenten['Yoga'],
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /*
         * NIEUWE LESSSENSYSTEEM: LESSONS
         */
        $lessonsData = [
            [
                'naam' => 'Ochtend Yoga',
                'beschrijving' => 'Begin de dag ontspannen met yoga.',
                'dagen' => 1,
                'begintijd' => '09:00:00',
                'eindtijd' => '10:00:00',
                'locatie' => 'Zaal A',
                'max_deelnemers' => 15,
                'begeleider_id' => $begeleiderLisaId,
            ],
            [
                'naam' => 'Power Spinning',
                'beschrijving' => 'Intensieve spinningles voor conditie en uithoudingsvermogen.',
                'dagen' => 2,
                'begintijd' => '18:00:00',
                'eindtijd' => '19:00:00',
                'locatie' => 'Spinningzaal',
                'max_deelnemers' => 12,
                'begeleider_id' => $begeleiderMarkId,
            ],
            [
                'naam' => 'Aquafit',
                'beschrijving' => 'Een actieve training in het zwembad.',
                'dagen' => 6,
                'begintijd' => '11:00:00',
                'eindtijd' => '11:45:00',
                'locatie' => 'Zwembad',
                'max_deelnemers' => 14,
                'begeleider_id' => $begeleiderLisaId,
            ],
        ];

        $lessons = collect($lessonsData)->map(function (array $les) {
            $datum = now()->startOfWeek()->addDays($les['dagen'])->toDateString();

            DB::table('lessons')->updateOrInsert(
                [
                    'naam' => $les['naam'],
                    'datum' => $datum,
                    'begintijd' => $les['begintijd'],
                    'begeleider_id' => $les['begeleider_id'],
                ],
                [
                    'beschrijving' => $les['beschrijving'],
                    'eindtijd' => $les['eindtijd'],
                    'locatie' => $les['locatie'],
                    'max_deelnemers' => $les['max_deelnemers'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            return DB::table('lessons')
                ->where('naam', $les['naam'])
                ->where('datum', $datum)
                ->where('begintijd', $les['begintijd'])
                ->where('begeleider_id', $les['begeleider_id'])
                ->value('id');
        });

        /*
         * NIEUWE LESSENSYSTEEM: ENROLLMENTS
         *
         * We vullen verschillende statussen zodat deze ook getest kunnen worden.
         */
        $enrollmentStatussen = [
            'ingeschreven',
            'bevestigd',
            'geannuleerd',
            'wachtlijst',
        ];

        foreach ($lessons as $lesIndex => $lessonId) {
            foreach ($leden as $lidIndex => $lidId) {
                // Niet iedere gebruiker schrijft zich voor iedere les in.
                if (($lidIndex + $lesIndex) % 3 === 0) {
                    continue;
                }

                $status = $enrollmentStatussen[($lidIndex + $lesIndex) % count($enrollmentStatussen)];

                DB::table('enrollments')->updateOrInsert(
                    [
                        'lesson_id' => $lessonId,
                        'user_id' => $lidId,
                    ],
                    [
                        'status' => $status,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
