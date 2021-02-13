<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResume extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|string',
            'content' => 'required|array',

            'content.basics' => 'required|array',
            'content.basics.name' => 'required|string',
            'content.basics.label' => 'required|string',
            'content.basics.email' => 'required|email',
            'content.basics.phone' => 'string',
            'content.basics.picture' => 'present',
            'content.basics.website' => 'url',
            'content.basics.summary' => 'string',
            'content.basics.location' => 'array',
            'content.basics.location.address' => 'string',
            'content.basics.location.postalCode' => 'string',
            'content.basics.location.city' => 'string',
            'content.basics.location.countryCode' => 'string',
            'content.basics.location.region' => 'string',
            'content.basics.profiles' => 'array',
            'content.basics.profiles.*.network' => 'string',
            'content.basics.profiles.*.username' => 'string',
            'content.basics.profiles.*.url' => 'url',

            'content.work' => 'array',
            'content.work.*.company' => 'string',
            'content.work.*.position' => 'string',
            'content.work.*.website' => 'url',
            'content.work.*.startDate' => 'date',
            'content.work.*.endDate' => 'date',
            'content.work.*.summary' => 'string',
            'content.work.*highlights' => 'array',
            'content.work.*highlights.*' => 'string',

            'content.education' => 'array',
            'content.education.*.institution' => 'string',
            'content.education.*.area' => 'string',
            'content.education.*.startDate' => 'date',
            'content.education.*.endDate' => 'date',
            'content.education.*.gpa' => 'string',
            'content.education.*courses' => 'array',
            'content.education.*courses.*' => 'string',

            'content.awards' => 'array',
            'content.awards.*.title' => 'string',
            'content.awards.*.date' => 'date',
            'content.awards.*.awarder' => 'string',
            'content.awards.*.summary' => 'string',

            'content.skills' => 'array',
            'content.skills.*.name' => 'string',
            'content.skills.*.level' => 'string',
            'content.skills.*.keywords' => 'array',
            'content.skills.*.keywords.*' => 'string',
        ];
    }
}
