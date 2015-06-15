var $collectionHolder;

// setup an "add an Address" link
var $addAddressLink = $('<button class="btn btn-default"><a href="#" class="add_userAddress_link">Добавить адрес</a></button>');
var $delAddressLink = $('<button class="btn btn-default"><a href="#" class="del_userAddress_link">Удалить адрес</a></button>');
var $newLinkLi = $('<div class="clear-fix"></div>').append($addAddressLink).append($delAddressLink);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of userAddresss
    $collectionHolder = $('ul.userAddresses');

    $collectionHolder.find('.col-sm-2').toggleClass('col-sm-2 col-sm-4');
    $collectionHolder.find('.col-sm-10').toggleClass('col-sm-10 col-sm-8');

    // add the "add a userAddress" anchor and li to the userAddresss ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAddressLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new userAddress form (see next code block)
        addAddressForm($collectionHolder, $newLinkLi);

        $("input[name$='[zip]']").each(function() {
            $(this).rules('add', {
                digits: true,
                minlength: 5,
                maxlength: 6
            });
        });
    });

    $delAddressLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $(this).parent().parent().children('li').last().remove();
    });

    function addAddressForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index).replace(/col-sm-2/g, 'col-sm-4').replace(/col-sm-10/g, 'col-sm-8');

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a userAddress" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);
    }
});

