$(function()
{
    var category_id; //global
    var elementDeleted; // global represents   <tr>
    
    $(".deletecategory").click(function()
    {
        category_id = $(this).attr("rel");
        elementDeleted = $(this).parent().parent();
    });
    
    $(".confirmDelete").click(function()
    {
        var datasend = {"category_id":category_id};
        
        $.post("ajaxdeletecategory.php", datasend , function(output)
        {
            if(output=="ok")
            {
                $(elementDeleted).hide();
            }
        });
    });
});