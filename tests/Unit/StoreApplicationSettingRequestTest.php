<?php

namespace Tests\Unit;

use App\ApplicationSetting;
use App\Http\Requests\StoreApplicationSettingRequest;

class StoreApplicationSettingRequestTest extends FormRequestTestCase
{
    /** @test */
    public function it_does_not_allow_empty_fields()
    {
        $this->assertFieldsRequired(['input_type']);
    }

    /** @test */
    public function it_does_not_allow_duplicate_key_value()
    {
        $setting = $this->createModel(['key' => 'test-setting']);
        $validator = $this->passingValidator(['key' => $setting->key]);
        $this->assertValidationRuleFailed($validator, 'key', $setting->key, 'Unique');
    }

    /** @test */
    public function it_does_not_allow_non_string_key()
    {
        $validator = $this->passingValidator(['key' => 1234]);
        $this->assertValidationRuleFailed($validator, 'key', 1234, 'String');
    }

    /** @test */
    public function it_does_not_allow_non_string_value()
    {
        $validator = $this->passingValidator(['value' => 1234]);
        $this->assertValidationRuleFailed($validator, 'value', 1234, 'String');
    }

    /** @test */
    public function it_allows_string_key()
    {
        $validator = $this->passingValidator(['key' => 'test-setting']);
        $this->assertValidationPasses($validator);
    }

    /** @test */
    public function it_allows_string_value()
    {
        $validator = $this->passingValidator(['value' => 'test-value']);
        $this->assertValidationPasses($validator);
    }

    /** @test */
    public function it_stores_new_setting_in_the_database()
    {
        $input = $this->modelFields(['key' => 'key', 'value' => 'value']);
        $setting = $this->createFormRequest($input)->save();
        $this->assertDatabaseHas('application_settings', $input);
        $this->assertEquals(ApplicationSetting::count(), 1);
        $this->assertEquals('key', $setting->key);
        $this->assertEquals('value', $setting->value);
    }

    /** @test */
    public function it_stores_updated_setting_in_the_database()
    {
        $setting = $this->createModel(['key' => 'key', 'value' => 'value']);
        $setting->value = 'updated-value';
        $changed_fields = $setting->toArray();
        $this->createFormRequest($changed_fields)->save();
        $this->assertDatabaseHas('application_settings', $changed_fields);
        $this->assertEquals(ApplicationSetting::count(), 1);
        $this->assertEquals('key', $setting->key);
        $this->assertEquals('updated-value', $setting->value);
    }

    /**
     * @inheritDoc
     */
    protected function modelUnderTestClass()
    {
        return ApplicationSetting::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestUnderTestClass()
    {
        return StoreApplicationSettingRequest::class;
    }
}
