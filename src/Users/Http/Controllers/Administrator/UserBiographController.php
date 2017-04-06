<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Myrtle\MaritalStatuses\Models\MaritalStatus;
use App\Http\Controllers\Controller;
use Myrtle\Core\Users\Models\User;
use Myrtle\Genders\Models\Gender;
use Myrtle\Religions\Models\Religion;
use Myrtle\Ethnicities\Models\Ethnicity;

class UserBiographController extends Controller
{
	public function __construct()
	{
		$this->genders = Gender::pluck('name', 'id');
		$this->religions = Religion::pluck('name', 'id');
		$this->ethnicities = Ethnicity::pluck('name', 'id');
		$this->maritalstatuses = MaritalStatus::pluck('name', 'id');
	}

	public function edit(User $user)
	{
		return view('admin::users.biograph.edit', [
			'user' => $user,
			'genders' => $this->genders,
			'ethnicities' => $this->ethnicities,
			'maritalstatuses' => $this->maritalstatuses,
			'religions' => $this->religions,
		]);
	}

	public function update(Request $request, User $user)
	{
		$user->biograph->fill(['birth_date' => empty($request->birth_date) ? null : $request->birth_date]);

		$user->biograph->fill(['gender_id' => empty($request->gender_id) ? null : $request->gender_id]);

		$user->biograph->fill(['ethnicity_id' => empty($request->ethnicity_id) ? null : $request->ethnicity_id]);

		$user->biograph->fill(['marital_status_id' => empty($request->marital_status_id) ? null : $request->marital_status_id]);

		$user->biograph->fill(['religion_id' => empty($request->religion_id) ? null : $request->religion_id]);

		if ($user->biograph->isDirty())
		{
			$user->biograph->save();
		}

		flasher()->alert('Biograph updated successfully', 'success');

		return redirect(route('admin.users.show', $user->id));
	}
}
