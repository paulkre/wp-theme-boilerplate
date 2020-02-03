import $ from "jquery";

import "./style.scss";

$(".header__nav__button").click(({ target }) =>
  $(target)
    .parent(".header__nav")
    .toggleClass("open")
);
