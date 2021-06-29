<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\People;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeopleManagementTest extends TestCase
{
   use RefreshDatabase;
    /** @test */ 
   public function a_person_can_be_added_to_the_database()
   {
       $this->withoutExceptionHandling();
       $user = User::factory()->create();
       $this->actingAs($user); 

       $response = $this->post('/person', $this->data());
       $person = People::first();        
       $this->assertCount(1, People::all());   
       $response->assertRedirect('person/' . $person->id);       
   }

    /** @test */
    public function all_people_can_be_viewed()
    {      
      $user = User::factory()->create();
      $this->actingAs($user);
      
      $response = $this->get('person');
      $response->assertStatus(200);             
    }

    /** @test */
    public function a_person_record_can_be_viewed()
    {      
      $user = User::factory()->create();
      $this->actingAs($user);
      
      $response = $this->post('/person', $this->data());
    
      $person = People::first();    
      $response = $this->get('person/' . $person->id);    
      $this->assertCount(1, People::all());  
    }




     /** @test */
     public function all_fields_are_required()
     {       
         $user = User::factory()->create();
         $this->actingAs($user);       
         
         $this->post('person', [])->assertSessionMissing(
             'name', 
             'surname', 
             'sa_id', 
             'mobile', 
             'email',
             'dob',
             'language',
             'ínterests',
          );        
     }
 
      /** @test */
      public function name_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => '',
             'surname' => 'Smith',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('name');
          
      }
 
      /** @test */
      public function surname_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => '',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('surname');
          
      }
 
      /** @test */
      public function sa_id_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => 'Smith',
             'sa_id' => '',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('sa_id');
          
      }
 
      /** @test */
      public function mobile_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => 'Smith',
             'sa_id' => '1111111111111',
             'mobile' => '',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('mobile');
          
      }
 
      /** @test */
      public function email_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => 'Smith',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => '',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('email');
          
      }
 
      /** @test */
      public function dob_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => '',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => 'Hockey'
          ])->assertSessionMissing('dob');
          
      }
 
      /** @test */
      public function language_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => 'Smith',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => '',
             'interests' => 'Hockey'
          ])->assertSessionMissing('language');
          
      }
 
      /** @test */
      public function interests_is_a_required_field()
      {       
          $user = User::factory()->create();
          $this->actingAs($user);       
          
          $this->post('person', [
             'name' => 'John',
             'surname' => 'Smith',
             'sa_id' => '1111111111111',
             'mobile' => '0615410899',
             'email' => 'john@abc.com',
             'dob' => '01/01/1990',
             'language' => 'English',
             'interests' => ''
          ])->assertSessionMissing('interests');
          
      }

       /** @test **/     
    public function a_person_record_can_be_updated()
    {  
             $this->withoutExceptionHandling();
             $user = User::factory()->create();
             $this->actingAs($user); 
 
         $response = $this->post('/person', $this->data());
    
         $person = People::first();    
         $response = $this->patch('person/' . $person->id, [
                 'name' => 'Michael',
                 'surname' => 'Jones',
                 'sa_id' => '2222222222222',
                 'mobile' => '0658636637',
                 'email' => 'michael@abc.com',
                 'dob' => '01/01/2000',
                 'language' => 'Zulu',
                 'interests' => 'Cricket'
             ]);
 
             $this->assertEquals('Michael', People::first()->name);  
             $this->assertEquals('Jones', People::first()->surname);
             $this->assertEquals('2222222222222', People::first()->sa_id);
             $this->assertEquals('0658636637', People::first()->mobile);
             $this->assertEquals('michael@abc.com', People::first()->email);
             $this->assertEquals('01/01/2000', People::first()->dob);
             $this->assertEquals('Zulu', People::first()->language);
             $this->assertEquals('Cricket', People::first()->interests);
 
             $response->assertRedirect('person/' . $person->id);
        
  }
 
             /** @test **/    
     public function a_person_record_can_be_deleted()
         {  
             $this->withoutExceptionHandling();
             $user = User::factory()->create();
             $this->actingAs($user); 
 
         $response = $this->post('/person', $this->data());
    
         $person = People::first();    
         $response = $this->delete('person/' . $person->id);
         $this->assertCount(0, People::all());
         $response->assertRedirect('person');  
             
         }  
 

    private function data()
    {
        return [
            'name' => 'John',
            'surname' => 'Smith',
            'sa_id' => '1111111111111',
            'mobile' => '0615410899',
            'email' => 'john@abc.com',
            'dob' => '01/01/1990',
            'language' => 'English',
            'interests' => 'Hockey'
        ];
    } 
}
