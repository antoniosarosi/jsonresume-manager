<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => "Testing",
            "content" => [
                "basics" => [
                    "name" => $this->faker->name(),
                    "label" => $this->faker->jobTitle,
                    "picture" => "/storage/images/default.png",
                    "email" => $this->faker->safeEmail,
                    "phone" => $this->faker->phoneNumber,
                    "website" => $this->faker->url,
                    "summary" => "A summary of John Doe...",
                    "location" => [
                        "address" => "2712 Broadway St",
                        "postalCode" => "CA 94115",
                        "city" => "San Francisco",
                        "countryCode" => "US",
                        "region" => "California"
                    ],
                    "profiles" => [
                        [
                            "network" => "Twitter",
                            "username" => "john",
                            "url" => "http://twitter.com/john"
                        ]
                    ]
                ],
                "work" => [
                    [
                        "company" => "Company",
                        "position" => "President",
                        "website" => "http://company.com",
                        "startDate" => "2013-01-01",
                        "endDate" => "2014-01-01",
                        "summary" => "Description...",
                        "highlights" => [
                            "Started the company"
                        ]
                    ]
                ],
                "education" => [
                    [
                        "institution" => "University",
                        "area" => "Software Development",
                        "studyType" => "Bachelor",
                        "startDate" => "2011-01-01",
                        "endDate" => "2013-01-01",
                        "gpa" => "4.0",
                        "courses" => [
                            "DB1101 - Basic SQL"
                        ],
                    ]
                ],
                "awards" => [
                    [
                        "title" => "Award",
                        "date" => "2014-11-01",
                        "awarder" => "Company",
                        "summary" => "There is no spoon."
                    ]
                ],
                "skills" => [
                    [
                        "name" => "Web Development",
                        "level" => "Master",
                        "keywords" => [
                            "HTML",
                            "CSS",
                            "Javascript"
                        ]
                    ]
                ],
            ]
        ];
    }
}
