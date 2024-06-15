<?php

namespace App;

enum PostType: string
{
    case Post = 'post';
    case Activity = 'kegiatan';
    case Anouncement = 'pengumuman';

}
