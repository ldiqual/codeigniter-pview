Pview for CodeIgniter
=====================
What is Pview ?
---------------

Pview, which is inspired from Contentful for Codeigniter and Rails template system, allows you create in-depth partial views.
You will be able to call a view that will successively refer to a parent view, settings the content of its sections.

Installation
------------

Download the [tarball][1] or the [zipball][2], and copy the following files into your application directory:
   * libraries/Pview.php
   * helpers/pview\_helper.php

Usage
-----

### In your controller: `application/controllers/mycontroller.php`:

    class MyController extends CI_Controller
    {
      public function my_method()
      {
        ...
        $this->load->view('my_method.html.php');
      }
    }

### In your view `application/views/my_method.html.php`:

    <?php set_parent('default') ?>
    
    <?php content_for('section1') ?>
      <span>Section 1</span>
    <?php end_content_for() ?>
    
    <?php content_for('section2') ?>
      <span>Section 2</span>
    <?php end_content_for() ?>
    
    <?php show() ?>

  This subview refer to a parent `default.html.php` and will set its `section1` and `section2` content with the one you put between `content_for` and `end_content_for`.

### In your parent view `application/views/default.html.php`:

    <html>
      <body>
        <div><?= content_of('section1') ?></div>
        <div><?= content_of('section2') ?></div>
        <div>
          <?php if (content_exists('section3')){ ?>
            <?= content_of('section3') ?>
          <?php } else { ?>
            Default Content 3
          <?php } ?>
        </div>            
      </body>
    </html>

### That will output the following code:

    <html>
      <body>
        <div>Section 1</div>
        <div>Section 2</div>
        <div>Default Content 3</div>
      </body>
    </html>

You can embed many views with this system, to be as precise as possible.

Helpers reference
----------------

### `set_parent($path)`

Sets the current view parent to `application/views/$path.html.php`. `path` can contain a directory: eg `user/index`.
Any variable passed to the view through `$ci->load->view('view.html.php', $data)` will be available in the parent view.

### `content_for($str, [$content = false])`

Starts tag for a content that will be returned by `content_of($str)`.
`$content` allows you to quickly pass data to the parent view.

    <? content_for('text', 'here is some text'); ?>

    <? content_for('text'); ?>
      here is some text
    <? end_content_for(); ?>

### `content_of($str)`

Outputs the html/string content placed between `content_for($str)` and `end_content_for()` (or just the shortcut `content_for($str, $content)`).
It can be embedded between these same tags, to output something in an other content.

### `show()`

Generates the current view and his parent. It should be put at the very bottom of the current view, as any instruction after it will occurs at the end of the generated PHP code.

### `content_exists($str)`

Returns wether `$str`'s content is defined or not.

[1]: https://github.com/ldiqual/codeigniter-pview/tarball/master
[2]: https://github.com/ldiqual/codeigniter-pveiw/zipball/master
