<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;
use Storage;
use Response;
use Venturecraft\Revisionable\RevisionableTrait;
use Kalnoy\Nestedset\NodeTrait;


class File extends Model
{
    use ValidatingTrait;
    use SoftDeletes;
    use RevisionableTrait;
    use NodeTrait;



    protected $onlyUseExistingTags = false;


    protected $rules = [
        'name' => 'required',
        'user_id' => 'required|exists:users,id',
        'group_id' => 'required|exists:groups,id',
    ];

    protected $table = 'files';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $casts = [ 'user_id' => 'integer' ];


    // Item type can be :
    // 0 : file (stored on the server)
    // 1 : folder (virtual folders)
    // 2 : link (to an etherpad or google doc for instance)

    const FILE = 0;
    const FOLDER = 1;
    const LINK = 2;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }


    public function link()
    {
        return action('FileController@download', [$this->group, $this]);
    }


    public function isFile()
    {
        return $this->item_type == $this::FILE;

    }

    public function isFolder()
    {
        return $this->item_type == $this::FOLDER;
    }

    public function isLink()
    {
        return $this->item_type == $this::LINK;
    }



    public function getParent()
    {
        if (is_null($this->parent_id))
        {
            return false;
        }
        else
        {
            return File::findOrFail($this->parent_id);
        }
    }


    public function addChild(File $file)
    {
        if ($this->isFolder())
        {
            $file->parent_id = $this->id;
            return $file->save();
        }
        else
        {
            return false;
        }
    }


    public function getAncestors()
    {
        $ancestors = [];

        $current = $this;
        // limit tree depth to 5 just in case, and this way we avoid recursive function
        for ($i = 0; $i <5; $i++)
        {
            $parent =  $current->getParent();

            if ($parent)
            {
                $ancestors[] = $parent;
                $current = $parent;
            }
            else
            {
                break;
            }
        }
        return $ancestors;

    }







}
