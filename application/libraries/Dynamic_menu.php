<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_menu        = 'id="menud"';
    private $class_menu        = 'class="menud"';
    private $class_parent    = 'class="parent"';
    private $class_last        = 'class="last"';

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }

    // --------------------------------------------------------------------

    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
    function build_menu($user_level)
    {
        $menu = array();

        // use active record database to get the menu.
		/*
		public function get_menu_for_level($user_level){
			$this->db->from('menu');
			$this->db->like('menu_allowed','+'.$user_level.'+');
			$this->db->order_by('urut', 'asc');
			$result = $this->db->get();
			return $result;
		}
		
		$this->ci->db->order_by('page_id','asc');
        $query = $this->ci->db->get($table);
		*/
		
		$this->ci->db->from('dyn_menu');
		$this->ci->db->like('menu_allowed','+'.$user_level.'+');
		//$this->ci->db->order_by('page_id', 'asc');
		$query = $this->ci->db->get();
		
        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`
			$r_id = 1;
            foreach ($query->result() as $row)
            {
                $menu[$r_id]['id']            = $row->id;
                $menu[$r_id]['title']        = $row->title;
                $menu[$r_id]['link']            = $row->link_type;
                $menu[$r_id]['page']            = $row->page_id;
                $menu[$r_id]['module']        = $row->module_name;
                $menu[$r_id]['url']            = $row->url;
                $menu[$r_id]['uri']            = $row->uri;
                $menu[$r_id]['dyn_group']    = $row->dyn_group_id;
                $menu[$r_id]['position']        = $row->position;
                $menu[$r_id]['target']        = $row->target;
                $menu[$r_id]['parent']        = $row->parent_id;
                $menu[$r_id]['is_parent']    = $row->is_parent;
                $menu[$r_id]['show']            = $row->show_menu;

                $r_id ++;
            }
        }
        $query->free_result();    // The $query result object will no longer be available
        /*
		echo "<pre>";
		print_r($menu);
		echo "</pre>";
		*/
        // ----------------------------------------------------------------------     
        // now we will build the dynamic menus.
        $html_out  = "\t".'<div '.$this->id_menu.'>'."\n";
		
		$html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
		
		// loop through the $menu array() and build the parent menus.		
        for ($i = 1;$i <= count($menu); $i++)
        {
            if (is_array($menu[$i]))    // must be by construction but let's keep the errors home
            {
            	//echo $i;echo('<br>');
				if ($menu[$i]['show'] && $menu[$i]['parent'] == 0)    // are we allowed to see this menu?
                {
                    if ($menu[$i]['is_parent'] == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t\t\t".'<li>'.anchor('', '<span>'.$menu[$i]['title'].'</span>');
                    }
                    else
                    {
                        $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span>'.$menu[$i]['title'].'</span>');
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs($menu, $menu[$i]['id']);

                    $html_out .= '</li>'."\n";
                }
				
			}else{
                exit (sprintf('menu nr %s must be an array', $i));
            }
        }

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= "\t".'</div>' . "\n";

        return $html_out;
    }  
	/**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($menu, $parent_id)
    {
        $has_subcats = FALSE;

        $html_out  = '';
        $html_out .= "\n\t\t\t\t".'<div>'."\n";
        $html_out .= "\t\t\t\t\t".'<ul>'."\n";

        for ($i = 1; $i <= count($menu); $i++)
        {
            if ($menu[$i]['show'] && $menu[$i]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;

                if ($menu[$i]['is_parent'] == TRUE)
                {
                    $html_out .= "\t\t\t\t\t\t".'<li>'.anchor('#', '<span>'.$menu[$i]['title'].'</span>');
                }
                else
                {
                    $html_out .= "\t\t\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span>'.$menu[$i]['title'].'</span>');
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $menu[$i]['id']);

                $html_out .= '</li>' . "\n";
            }
        }
        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        $html_out .= "\t\t\t\t".'</div>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;
    }		
}


// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  