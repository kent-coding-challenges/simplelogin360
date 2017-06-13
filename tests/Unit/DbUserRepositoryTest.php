<?php

namespace Tests\Unit;

use App\User;
use App\Repositories\DbUserRepository;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DbUserRepositoryTest extends TestCase
{
    // Ensure each test is wrapped in it's own transaction.
    use DatabaseTransactions;

    /**
     * Test store() in user repository.
     *
     * @return void
     */
    public function testStore()
    {
        $repo = new DbUserRepository();
        $old_count = User::count();

        // Create a new user using store() function in repo.
        $user = factory(User::class)->make();
        $repo->store($user);

        // Ensure exactly one record has been created.
        $new_count = User::count();
        $this->assertEquals($new_count, $old_count + 1);
    }

    /**
     * Test update() in user repository.
     *
     * @return void
     */
    public function testUpdate()
    {
        $repo = new DbUserRepository();

        // Create a new user and update via repo.
        $user = factory(User::class)->create();
        $user->first_name = 'Ken';
        $user->last_name = 'Timothy';
        $user->email = 'new_' . $user->email;
        $repo->update($user->id, $user);

        $updated_user = User::find($user->id);
        $this->assertTrue($updated_user != null);

        // Ensure updated fields are reflected.
        $this->assertEquals($user->first_name, $updated_user->first_name);
        $this->assertEquals($user->last_name, $updated_user->last_name);
        $this->assertEquals($user->email, $updated_user->email);
    }

    /**
     * Test updatePassword() in user repository.
     *
     * @return void
     */
    public function testUpdatePassword()
    {
        $repo = new DbUserRepository();

        // Create a new user and store to repo (password = secret).
        $user = factory(User::class)->create();
        $repo->updatePassword($user->id, 'secret', 'newsecret');

        $updated_user_with_new_password = User::find($user->id);
        $this->assertTrue($updated_user_with_new_password != null);

        // Ensure password has been updated successfully.
        $this->assertFalse(Hash::check('secret', $updated_user_with_new_password->password));
        $this->assertTrue(Hash::check('newsecret', $updated_user_with_new_password->password));
    }

    /**
     * Test destroy() in user repository.
     *
     * @return void
     */
    public function testDestroy()
    {
        $repo = new DbUserRepository();

        // Create a new user and destroy via repo.
        $user = factory(User::class)->create();
        $repo->destroy($user->id);

        // Ensure user has been successfully deleted.
        $deleted_user = User::find($user->id);
        $this->assertTrue($deleted_user == null);
    }

    /**
     * Test find() in user repository.
     *
     * @return void
     */
    public function testFind()
    {
        $repo = new DbUserRepository();

        // Create a new user and store to repo.
        $user = factory(User::class)->create();
        $found_user = $repo->find($user->id);

        $this->assertTrue($found_user != null);
        $this->assertEquals($user->id, $found_user->id);
    }

    /**
     * Test count() in user repository.
     *
     * @return void
     */
    public function testCount()
    {
        $repo = new DbUserRepository();

        // Ensure count from repo matches actual count.
        $count = User::count();
        $repo_count = $repo->count();
        $this->assertTrue($count == $repo_count);
    }
}
