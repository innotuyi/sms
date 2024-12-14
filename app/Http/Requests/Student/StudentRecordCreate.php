<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Qs;

class StudentRecordCreate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:150',
            'adm_no' => 'sometimes|nullable|alpha_num|min:3|max:150|unique:student_records',
            'gender' => 'required|string',
            'year_admitted' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'bg_id' => 'sometimes|nullable',
            'my_class_id' => 'required',
            'section_id' => 'required',
            'my_parent_id' => 'sometimes|nullable',
            'dorm_id' => 'sometimes|nullable',
            'school_id' => 'required|exists:schools,id', // Ensure school_id exists in the schools table
            'arrival_time' => 'sometimes|nullable|date_format:Y-m-d\TH:i',
            'departure_time' => 'sometimes|nullable|date_format:Y-m-d\TH:i',
            'brought_by' => 'sometimes|nullable|string|max:255',
            'sickness' => 'sometimes|nullable|string|max:255',
            'insurance' => 'sometimes|nullable|string|max:255',
            'special_insurance' => 'sometimes|nullable|string|max:255',
            'fees_status' => 'sometimes|nullable|string|max:255',
            'fees_paid' => 'sometimes|nullable|integer|min:0',
            'remaining_fees' => 'sometimes|nullable|integer|min:0',
            'balance_date' => 'sometimes|nullable|date',
            'other_organization' => 'sometimes|nullable|string|max:255',
            'pocket_money' => 'sometimes|nullable|integer|min:0',
            'pocket_money_to_go_home' => 'sometimes|nullable|string|max:255',
            'pocket_money_amount' => 'sometimes|nullable|integer|min:0',
            'hygiene_materials_complete' => 'sometimes|nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return  [
            'section_id' => 'Section',
            'nal_id' => 'Nationality',
            'my_class_id' => 'Class',
            'dorm_id' => 'Dormitory',
            'state_id' => 'State',
            'lga_id' => 'LGA',
            'bg_id' => 'Blood Group',
            'my_parent_id' => 'Parent',
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['my_parent_id'] = $input['my_parent_id'] ? Qs::decodeHash($input['my_parent_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
