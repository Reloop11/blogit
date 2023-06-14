$(document).ready(function () {
    /**
     * Tag input field controller
     */

    function addTag(item, list) {
        let validTag = true;
        let text = item.text();
        let lower = text.toLowerCase();

        if (getTagCount(list) >= 5) {
            validTag = false;
        } else {
            list.children('.tag').each(function() {
                if (lower === $(this).text().toLowerCase()) {
                    validTag = false;
                    return false;
                }            
            });
        }

        if (validTag) {
            let tag = $('<span></span>').addClass('tag').text(text);
            let data = $('<input>').addClass('d-none').attr('name', 'tags[]').val(text);
            let close = $('<img></img>').addClass('tag-close').attr('src', '/images/icons/close.png');

            tag.append(close);
            tag.append(data);
            list.append(tag);
        }
    }

    function getTagCount(list) {
        let tags = list.children('.tag');
        return tags.length;
    }

    function changeBorders(withBorders) {
        $('.tag-input-container').toggleClass('border-bottom', withBorders);
    }

    function showDropdown(dropdown) {
        dropdown.slideDown(200);
        changeBorders(false);
    }

    function hideDropdown(dropdown) {
        dropdown.slideUp(200);
        changeBorders(true);
    }

    function resetInput(input, focus = true) {
        input.val('');
        if (focus) {
            input.focus();
        }
    }

    let changeTimeoutId;
    $('.tag-input-container .tag-input').each(function() {
        let input = $(this);
        let dropdown = input.closest('.tag-input-container').children('.tag-dropdown:first');
        let list = input.closest('.tag-input-container').children('.tag-container:first');
        
        $(this)
            .on('focusin paste keyup', function() {
                if (getTagCount(list) >= 5) {
                    return
                }

                if (changeTimeoutId) {
                    clearTimeout(changeTimeoutId);
                    changeTimeoutId = null;
                }
                
                changeTimeoutId = setTimeout(function() {
                    let value = input.val().toLowerCase().trim();
                    let except = [];
                    
                    list.find('.tag').each(function() {
                        except.push($(this).text());
                    });

                    $.ajax({
                        type: "GET",
                        url: "/search-tags",
                        data: {
                            "query": value,
                            'except': except
                        },
                        success: function (response) {
                            if (response.length > 0) {
                                dropdown.html(response);
                                showDropdown(dropdown)
                            } else {
                                hideDropdown(dropdown)
                            }
                        }
                    });
                }, 100);
            })
            .on('keypress', function(event) {
                if (event.keyCode == 13) { // Enter Key
                    event.preventDefault();
                    
                    let count = getTagCount(list);
                    if (count < 5) {
                        let items = dropdown.find('li');
                    
                        if (items.length >= 1) {
                            addTag($(items[0]), list);
                            resetInput(input);
                        }

                        if (count == 4) {
                            hideDropdown(dropdown);
                            input.prop('disabled', true);
                        }
                    } 
                    
                    return false;
                }
            });
    });
        

    $(document)
        .on('click', '.tag .tag-close', function() {
            $(this).closest('.tag-input-container').children('.tag-input:first').prop('disabled', false);
            $(this).parent().remove();
        })
        .on('click', '.tag-dropdown li', function(event) {
            event.stopPropagation();

            let dropdown = $(this).closest('.tag-dropdown')
            let list = dropdown.siblings('.tag-container:first');
            let input = dropdown.siblings('.tag-input:first');
            let item = $(this);

            if (getTagCount(list) == 4) {
                input.prop('disabled', true);
            }

            addTag(item, list);
            hideDropdown(dropdown);
            resetInput(input, false);
        });
    
    $(window).click(function() {
        $('.tag-dropdown').each(function() {
            hideDropdown($(this));
        });
    });

    /**
     *  Discard
     */
    $('.post-discard').click(function(event) {
        event.preventDefault();
        
        if (confirm('Are you sure of discarding the post. This action can\'t be undone')) {
            $(this).closest('form').submit();
        }
    });

    // $(window).bind('beforeunload', function() {
    //     return confirm("Are you sure of leaving this page. Changes will be discared.");
    // });
});