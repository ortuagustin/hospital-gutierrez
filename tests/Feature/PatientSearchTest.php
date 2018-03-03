<?php

namespace Tests\Feature;

use App\Patient;
use Tests\Helpers\FakeReferenceDataTestHelper;
use Tests\Helpers\PatientTestHelper;

class PatientSeachTest extends FeatureTest
{
    use PatientTestHelper, FakeReferenceDataTestHelper;

    /** @test */
    public function authorized_users_can_search_patients()
    {
        $this->withAlgolia()
             ->signIn();

        try {
            $this->createPatients(2);

            $this->createPatients(2, [
                'name'                   => 'foo-bar-baz',
                'doc_type_id'            => 1,
                'home_type_id'           => 1,
                'water_type_id'          => 1,
                'heating_type_id'        => 1,
                'medical_insurance_id'   => 1,
            ]);

            do {
                sleep(.750);
                $results = $this->getJson('/patients/search?q=foo')->json()['data'];
            } while (empty($results));

            $this->assertCount(2, $results, 'The search by Algolia should return 2 matches, but it may be a false-negative due to Algolia needing to reindex');
        } finally {
            Patient::all()->unsearchable();
        }
    }

    /** @test */
    public function non_authorized_users_can_search_patients()
    {
        $this->withExceptionHandling();

        $this->get('/patients/search')
             ->assertRedirect(route('login'));

        $this->getJson('/patients/search')
             ->assertStatus(401);
    }

    /**
     * Sets the Scout Driver to Algolia and some necesary mocks
     * @return $this
     */
    protected function withAlgolia()
    {
        $this->swapRepository(\App\Contracts\MedicalInsurancesRepositoryInterface::class, [$this->makeReferenceModel(1, 'IOMA')]);
        $this->swapRepository(\App\Contracts\DocTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'DNI')]);
        $this->swapRepository(\App\Contracts\HomeTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Flat')]);
        $this->swapRepository(\App\Contracts\WaterTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Water Well')]);
        $this->swapRepository(\App\Contracts\HeatingTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Electrical')]);

        config(['scout.driver' => 'algolia']);

        return $this;
    }
}
