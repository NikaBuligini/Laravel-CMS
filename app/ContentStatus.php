<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentStatus extends Model {

	protected $table = 'content_statuses';

	protected $fillable = ['name'];

}
