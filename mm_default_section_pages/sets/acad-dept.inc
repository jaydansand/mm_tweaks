<?php
function mm_default_section_pages_acad_dept_majmin($mmtid, $page)
{
  $args = func_get_args();
  $subj = lu_relationships_dept_to_subj($args[1]);
  $args[] = $subj;
  return 'Placeholder Major/Minor page content for ' . $page . ' (' . $subj . ') <!--' . print_r($args, TRUE) . ' -->';
}

function mm_default_section_pages_acad_dept_course_descriptions($mmtid, $page)
{
  $args = func_get_args();
  $subj = lu_relationships_dept_to_subj($args[1]);
  $args[] = $subj;
  return 'Placeholder Course Descriptions page content for ' . $page . ' (' . $subj . ') <!--' . print_r($args, TRUE) . ' -->';
}

function mm_default_section_pages_acad_dept_faculty($mmtid, $page)
{
  $args = func_get_args();
  $subj = lu_relationships_dept_to_subj($args[1]);
  $args[] = $subj;
  return views_embed_view('lu_people', 'dept_faculty_list', $subj); 
}

function mm_default_section_pages_acad_dept_class_schedule($mmtid, $page)
{
  $args = func_get_args();
  $subj = lu_relationships_dept_to_subj($args[1]);
  $args[] = $subj;
  return 'Placeholder Class Schedule page content for ' . $page . ' (' . $subj . ') <!--' . print_r($args, TRUE) . ' -->';
}
