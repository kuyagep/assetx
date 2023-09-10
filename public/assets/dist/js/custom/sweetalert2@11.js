/*!
 * sweetalert2 v11.7.27
 * Released under the MIT License.
 */
!(function (t, e) {
  "object" == typeof exports && "undefined" != typeof module
    ? (module.exports = e())
    : "function" == typeof define && define.amd
    ? define(e)
    : ((t =
        "undefined" != typeof globalThis
          ? globalThis
          : t || self).Sweetalert2 = e());
})(this, function () {
  "use strict";
  function t(t, e) {
    return (function (t, e) {
      if (e.get) return e.get.call(t);
      return e.value;
    })(t, n(t, e, "get"));
  }
  function e(t, e, o) {
    return (
      (function (t, e, n) {
        if (e.set) e.set.call(t, n);
        else {
          if (!e.writable)
            throw new TypeError("attempted to set read only private field");
          e.value = n;
        }
      })(t, n(t, e, "set"), o),
      o
    );
  }
  function n(t, e, n) {
    if (!e.has(t))
      throw new TypeError(
        "attempted to " + n + " private field on non-instance"
      );
    return e.get(t);
  }
  function o(t, e, n) {
    !(function (t, e) {
      if (e.has(t))
        throw new TypeError(
          "Cannot initialize the same private elements twice on an object"
        );
    })(t, e),
      e.set(t, n);
  }
  const i = {},
    s = (t) =>
      new Promise((e) => {
        if (!t) return e();
        const n = window.scrollX,
          o = window.scrollY;
        (i.restoreFocusTimeout = setTimeout(() => {
          i.previousActiveElement instanceof HTMLElement
            ? (i.previousActiveElement.focus(),
              (i.previousActiveElement = null))
            : document.body && document.body.focus(),
            e();
        }, 100)),
          window.scrollTo(n, o);
      });
  var r = { innerParams: new WeakMap(), domCache: new WeakMap() };
  const a = "swal2-",
    c = [
      "container",
      "shown",
      "height-auto",
      "iosfix",
      "popup",
      "modal",
      "no-backdrop",
      "no-transition",
      "toast",
      "toast-shown",
      "show",
      "hide",
      "close",
      "title",
      "html-container",
      "actions",
      "confirm",
      "deny",
      "cancel",
      "default-outline",
      "footer",
      "icon",
      "icon-content",
      "image",
      "input",
      "file",
      "range",
      "select",
      "radio",
      "checkbox",
      "label",
      "textarea",
      "inputerror",
      "input-label",
      "validation-message",
      "progress-steps",
      "active-progress-step",
      "progress-step",
      "progress-step-line",
      "loader",
      "loading",
      "styled",
      "top",
      "top-start",
      "top-end",
      "top-left",
      "top-right",
      "center",
      "center-start",
      "center-end",
      "center-left",
      "center-right",
      "bottom",
      "bottom-start",
      "bottom-end",
      "bottom-left",
      "bottom-right",
      "grow-row",
      "grow-column",
      "grow-fullscreen",
      "rtl",
      "timer-progress-bar",
      "timer-progress-bar-container",
      "scrollbar-measure",
      "icon-success",
      "icon-warning",
      "icon-info",
      "icon-question",
      "icon-error",
    ].reduce((t, e) => ((t[e] = a + e), t), {}),
    l = ["success", "warning", "info", "question", "error"].reduce(
      (t, e) => ((t[e] = a + e), t),
      {}
    ),
    u = "SweetAlert2:",
    d = (t) => t.charAt(0).toUpperCase() + t.slice(1),
    p = (t) => {
      console.warn(
        "".concat(u, " ").concat("object" == typeof t ? t.join(" ") : t)
      );
    },
    m = (t) => {
      console.error("".concat(u, " ").concat(t));
    },
    g = [],
    h = (t, e) => {
      var n;
      (n = '"'
        .concat(
          t,
          '" is deprecated and will be removed in the next major release. Please use "'
        )
        .concat(e, '" instead.')),
        g.includes(n) || (g.push(n), p(n));
    },
    f = (t) => ("function" == typeof t ? t() : t),
    b = (t) => t && "function" == typeof t.toPromise,
    y = (t) => (b(t) ? t.toPromise() : Promise.resolve(t)),
    w = (t) => t && Promise.resolve(t) === t,
    v = () => document.body.querySelector(".".concat(c.container)),
    C = (t) => {
      const e = v();
      return e ? e.querySelector(t) : null;
    },
    A = (t) => C(".".concat(t)),
    k = () => A(c.popup),
    B = () => A(c.icon),
    E = () => A(c.title),
    x = () => A(c["html-container"]),
    P = () => A(c.image),
    T = () => A(c["progress-steps"]),
    L = () => A(c["validation-message"]),
    S = () => C(".".concat(c.actions, " .").concat(c.confirm)),
    O = () => C(".".concat(c.actions, " .").concat(c.cancel)),
    M = () => C(".".concat(c.actions, " .").concat(c.deny)),
    j = () => C(".".concat(c.loader)),
    I = () => A(c.actions),
    H = () => A(c.footer),
    D = () => A(c["timer-progress-bar"]),
    q = () => A(c.close),
    V = () => {
      const t = k();
      if (!t) return [];
      const e = t.querySelectorAll(
          '[tabindex]:not([tabindex="-1"]):not([tabindex="0"])'
        ),
        n = Array.from(e).sort((t, e) => {
          const n = parseInt(t.getAttribute("tabindex") || "0"),
            o = parseInt(e.getAttribute("tabindex") || "0");
          return n > o ? 1 : n < o ? -1 : 0;
        }),
        o = t.querySelectorAll(
          '\n  a[href],\n  area[href],\n  input:not([disabled]),\n  select:not([disabled]),\n  textarea:not([disabled]),\n  button:not([disabled]),\n  iframe,\n  object,\n  embed,\n  [tabindex="0"],\n  [contenteditable],\n  audio[controls],\n  video[controls],\n  summary\n'
        ),
        i = Array.from(o).filter((t) => "-1" !== t.getAttribute("tabindex"));
      return [...new Set(n.concat(i))].filter((t) => et(t));
    },
    N = () =>
      R(document.body, c.shown) &&
      !R(document.body, c["toast-shown"]) &&
      !R(document.body, c["no-backdrop"]),
    F = () => {
      const t = k();
      return !!t && R(t, c.toast);
    },
    _ = (t, e) => {
      if (((t.textContent = ""), e)) {
        const n = new DOMParser().parseFromString(e, "text/html"),
          o = n.querySelector("head");
        o &&
          Array.from(o.childNodes).forEach((e) => {
            t.appendChild(e);
          });
        const i = n.querySelector("body");
        i &&
          Array.from(i.childNodes).forEach((e) => {
            e instanceof HTMLVideoElement || e instanceof HTMLAudioElement
              ? t.appendChild(e.cloneNode(!0))
              : t.appendChild(e);
          });
      }
    },
    R = (t, e) => {
      if (!e) return !1;
      const n = e.split(/\s+/);
      for (let e = 0; e < n.length; e++)
        if (!t.classList.contains(n[e])) return !1;
      return !0;
    },
    U = (t, e, n) => {
      if (
        (((t, e) => {
          Array.from(t.classList).forEach((n) => {
            Object.values(c).includes(n) ||
              Object.values(l).includes(n) ||
              Object.values(e.showClass || {}).includes(n) ||
              t.classList.remove(n);
          });
        })(t, e),
        e.customClass && e.customClass[n])
      ) {
        if ("string" != typeof e.customClass[n] && !e.customClass[n].forEach)
          return void p(
            "Invalid type of customClass."
              .concat(n, '! Expected string or iterable object, got "')
              .concat(typeof e.customClass[n], '"')
          );
        Y(t, e.customClass[n]);
      }
    },
    z = (t, e) => {
      if (!e) return null;
      switch (e) {
        case "select":
        case "textarea":
        case "file":
          return t.querySelector(".".concat(c.popup, " > .").concat(c[e]));
        case "checkbox":
          return t.querySelector(
            ".".concat(c.popup, " > .").concat(c.checkbox, " input")
          );
        case "radio":
          return (
            t.querySelector(
              ".".concat(c.popup, " > .").concat(c.radio, " input:checked")
            ) ||
            t.querySelector(
              ".".concat(c.popup, " > .").concat(c.radio, " input:first-child")
            )
          );
        case "range":
          return t.querySelector(
            ".".concat(c.popup, " > .").concat(c.range, " input")
          );
        default:
          return t.querySelector(".".concat(c.popup, " > .").concat(c.input));
      }
    },
    W = (t) => {
      if ((t.focus(), "file" !== t.type)) {
        const e = t.value;
        (t.value = ""), (t.value = e);
      }
    },
    K = (t, e, n) => {
      t &&
        e &&
        ("string" == typeof e && (e = e.split(/\s+/).filter(Boolean)),
        e.forEach((e) => {
          Array.isArray(t)
            ? t.forEach((t) => {
                n ? t.classList.add(e) : t.classList.remove(e);
              })
            : n
            ? t.classList.add(e)
            : t.classList.remove(e);
        }));
    },
    Y = (t, e) => {
      K(t, e, !0);
    },
    Z = (t, e) => {
      K(t, e, !1);
    },
    $ = (t, e) => {
      const n = Array.from(t.children);
      for (let t = 0; t < n.length; t++) {
        const o = n[t];
        if (o instanceof HTMLElement && R(o, e)) return o;
      }
    },
    J = (t, e, n) => {
      n === "".concat(parseInt(n)) && (n = parseInt(n)),
        n || 0 === parseInt(n)
          ? (t.style[e] = "number" == typeof n ? "".concat(n, "px") : n)
          : t.style.removeProperty(e);
    },
    X = function (t) {
      let e =
        arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "flex";
      t && (t.style.display = e);
    },
    G = (t) => {
      t && (t.style.display = "none");
    },
    Q = (t, e, n, o) => {
      const i = t.querySelector(e);
      i && (i.style[n] = o);
    },
    tt = function (t, e) {
      e
        ? X(
            t,
            arguments.length > 2 && void 0 !== arguments[2]
              ? arguments[2]
              : "flex"
          )
        : G(t);
    },
    et = (t) =>
      !(!t || !(t.offsetWidth || t.offsetHeight || t.getClientRects().length)),
    nt = (t) => !!(t.scrollHeight > t.clientHeight),
    ot = (t) => {
      const e = window.getComputedStyle(t),
        n = parseFloat(e.getPropertyValue("animation-duration") || "0"),
        o = parseFloat(e.getPropertyValue("transition-duration") || "0");
      return n > 0 || o > 0;
    },
    it = function (t) {
      let e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
      const n = D();
      n &&
        et(n) &&
        (e && ((n.style.transition = "none"), (n.style.width = "100%")),
        setTimeout(() => {
          (n.style.transition = "width ".concat(t / 1e3, "s linear")),
            (n.style.width = "0%");
        }, 10));
    },
    st = () => "undefined" == typeof window || "undefined" == typeof document,
    rt = '\n <div aria-labelledby="'
      .concat(c.title, '" aria-describedby="')
      .concat(c["html-container"], '" class="')
      .concat(c.popup, '" tabindex="-1">\n   <button type="button" class="')
      .concat(c.close, '"></button>\n   <ul class="')
      .concat(c["progress-steps"], '"></ul>\n   <div class="')
      .concat(c.icon, '"></div>\n   <img class="')
      .concat(c.image, '" />\n   <h2 class="')
      .concat(c.title, '" id="')
      .concat(c.title, '"></h2>\n   <div class="')
      .concat(c["html-container"], '" id="')
      .concat(c["html-container"], '"></div>\n   <input class="')
      .concat(c.input, '" id="')
      .concat(c.input, '" />\n   <input type="file" class="')
      .concat(c.file, '" />\n   <div class="')
      .concat(
        c.range,
        '">\n     <input type="range" />\n     <output></output>\n   </div>\n   <select class="'
      )
      .concat(c.select, '" id="')
      .concat(c.select, '"></select>\n   <div class="')
      .concat(c.radio, '"></div>\n   <label class="')
      .concat(c.checkbox, '">\n     <input type="checkbox" id="')
      .concat(c.checkbox, '" />\n     <span class="')
      .concat(c.label, '"></span>\n   </label>\n   <textarea class="')
      .concat(c.textarea, '" id="')
      .concat(c.textarea, '"></textarea>\n   <div class="')
      .concat(c["validation-message"], '" id="')
      .concat(c["validation-message"], '"></div>\n   <div class="')
      .concat(c.actions, '">\n     <div class="')
      .concat(c.loader, '"></div>\n     <button type="button" class="')
      .concat(c.confirm, '"></button>\n     <button type="button" class="')
      .concat(c.deny, '"></button>\n     <button type="button" class="')
      .concat(c.cancel, '"></button>\n   </div>\n   <div class="')
      .concat(c.footer, '"></div>\n   <div class="')
      .concat(c["timer-progress-bar-container"], '">\n     <div class="')
      .concat(c["timer-progress-bar"], '"></div>\n   </div>\n </div>\n')
      .replace(/(^|\n)\s*/g, ""),
    at = () => {
      i.currentInstance.resetValidationMessage();
    },
    ct = (t) => {
      const e = (() => {
        const t = v();
        return (
          !!t &&
          (t.remove(),
          Z(
            [document.documentElement, document.body],
            [c["no-backdrop"], c["toast-shown"], c["has-column"]]
          ),
          !0)
        );
      })();
      if (st()) return void m("SweetAlert2 requires document to initialize");
      const n = document.createElement("div");
      (n.className = c.container), e && Y(n, c["no-transition"]), _(n, rt);
      const o =
        "string" == typeof (i = t.target) ? document.querySelector(i) : i;
      var i;
      o.appendChild(n),
        ((t) => {
          const e = k();
          e.setAttribute("role", t.toast ? "alert" : "dialog"),
            e.setAttribute("aria-live", t.toast ? "polite" : "assertive"),
            t.toast || e.setAttribute("aria-modal", "true");
        })(t),
        ((t) => {
          "rtl" === window.getComputedStyle(t).direction && Y(v(), c.rtl);
        })(o),
        (() => {
          const t = k(),
            e = $(t, c.input),
            n = $(t, c.file),
            o = t.querySelector(".".concat(c.range, " input")),
            i = t.querySelector(".".concat(c.range, " output")),
            s = $(t, c.select),
            r = t.querySelector(".".concat(c.checkbox, " input")),
            a = $(t, c.textarea);
          (e.oninput = at),
            (n.onchange = at),
            (s.onchange = at),
            (r.onchange = at),
            (a.oninput = at),
            (o.oninput = () => {
              at(), (i.value = o.value);
            }),
            (o.onchange = () => {
              at(), (i.value = o.value);
            });
        })();
    },
    lt = (t, e) => {
      t instanceof HTMLElement
        ? e.appendChild(t)
        : "object" == typeof t
        ? ut(t, e)
        : t && _(e, t);
    },
    ut = (t, e) => {
      t.jquery ? dt(e, t) : _(e, t.toString());
    },
    dt = (t, e) => {
      if (((t.textContent = ""), 0 in e))
        for (let n = 0; n in e; n++) t.appendChild(e[n].cloneNode(!0));
      else t.appendChild(e.cloneNode(!0));
    },
    pt = (() => {
      if (st()) return !1;
      const t = document.createElement("div");
      return void 0 !== t.style.webkitAnimation
        ? "webkitAnimationEnd"
        : void 0 !== t.style.animation && "animationend";
    })(),
    mt = (t, e) => {
      const n = I(),
        o = j();
      n &&
        o &&
        (e.showConfirmButton || e.showDenyButton || e.showCancelButton
          ? X(n)
          : G(n),
        U(n, e, "actions"),
        (function (t, e, n) {
          const o = S(),
            i = M(),
            s = O();
          if (!o || !i || !s) return;
          gt(o, "confirm", n),
            gt(i, "deny", n),
            gt(s, "cancel", n),
            (function (t, e, n, o) {
              if (!o.buttonsStyling) return void Z([t, e, n], c.styled);
              Y([t, e, n], c.styled),
                o.confirmButtonColor &&
                  ((t.style.backgroundColor = o.confirmButtonColor),
                  Y(t, c["default-outline"]));
              o.denyButtonColor &&
                ((e.style.backgroundColor = o.denyButtonColor),
                Y(e, c["default-outline"]));
              o.cancelButtonColor &&
                ((n.style.backgroundColor = o.cancelButtonColor),
                Y(n, c["default-outline"]));
            })(o, i, s, n),
            n.reverseButtons &&
              (n.toast
                ? (t.insertBefore(s, o), t.insertBefore(i, o))
                : (t.insertBefore(s, e),
                  t.insertBefore(i, e),
                  t.insertBefore(o, e)));
        })(n, o, e),
        _(o, e.loaderHtml || ""),
        U(o, e, "loader"));
    };
  function gt(t, e, n) {
    const o = d(e);
    tt(t, n["show".concat(o, "Button")], "inline-block"),
      _(t, n["".concat(e, "ButtonText")] || ""),
      t.setAttribute("aria-label", n["".concat(e, "ButtonAriaLabel")] || ""),
      (t.className = c[e]),
      U(t, n, "".concat(e, "Button"));
  }
  const ht = (t, e) => {
    const n = v();
    n &&
      (!(function (t, e) {
        "string" == typeof e
          ? (t.style.background = e)
          : e || Y([document.documentElement, document.body], c["no-backdrop"]);
      })(n, e.backdrop),
      (function (t, e) {
        if (!e) return;
        e in c
          ? Y(t, c[e])
          : (p('The "position" parameter is not valid, defaulting to "center"'),
            Y(t, c.center));
      })(n, e.position),
      (function (t, e) {
        if (!e) return;
        Y(t, c["grow-".concat(e)]);
      })(n, e.grow),
      U(n, e, "container"));
  };
  const ft = [
      "input",
      "file",
      "range",
      "select",
      "radio",
      "checkbox",
      "textarea",
    ],
    bt = (t) => {
      if (!t.input) return;
      if (!Bt[t.input])
        return void m(
          'Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(
            t.input,
            '"'
          )
        );
      const e = At(t.input),
        n = Bt[t.input](e, t);
      X(e),
        t.inputAutoFocus &&
          setTimeout(() => {
            W(n);
          });
    },
    yt = (t, e) => {
      const n = z(k(), t);
      if (n) {
        ((t) => {
          for (let e = 0; e < t.attributes.length; e++) {
            const n = t.attributes[e].name;
            ["id", "type", "value", "style"].includes(n) ||
              t.removeAttribute(n);
          }
        })(n);
        for (const t in e) n.setAttribute(t, e[t]);
      }
    },
    wt = (t) => {
      const e = At(t.input);
      "object" == typeof t.customClass && Y(e, t.customClass.input);
    },
    vt = (t, e) => {
      (t.placeholder && !e.inputPlaceholder) ||
        (t.placeholder = e.inputPlaceholder);
    },
    Ct = (t, e, n) => {
      if (n.inputLabel) {
        const o = document.createElement("label"),
          i = c["input-label"];
        o.setAttribute("for", t.id),
          (o.className = i),
          "object" == typeof n.customClass && Y(o, n.customClass.inputLabel),
          (o.innerText = n.inputLabel),
          e.insertAdjacentElement("beforebegin", o);
      }
    },
    At = (t) => $(k(), c[t] || c.input),
    kt = (t, e) => {
      ["string", "number"].includes(typeof e)
        ? (t.value = "".concat(e))
        : w(e) ||
          p(
            'Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(
              typeof e,
              '"'
            )
          );
    },
    Bt = {};
  (Bt.text = Bt.email = Bt.password = Bt.number = Bt.tel = Bt.url = (t, e) => (
    kt(t, e.inputValue), Ct(t, t, e), vt(t, e), (t.type = e.input), t
  )),
    (Bt.file = (t, e) => (Ct(t, t, e), vt(t, e), t)),
    (Bt.range = (t, e) => {
      const n = t.querySelector("input"),
        o = t.querySelector("output");
      return (
        kt(n, e.inputValue),
        (n.type = e.input),
        kt(o, e.inputValue),
        Ct(n, t, e),
        t
      );
    }),
    (Bt.select = (t, e) => {
      if (((t.textContent = ""), e.inputPlaceholder)) {
        const n = document.createElement("option");
        _(n, e.inputPlaceholder),
          (n.value = ""),
          (n.disabled = !0),
          (n.selected = !0),
          t.appendChild(n);
      }
      return Ct(t, t, e), t;
    }),
    (Bt.radio = (t) => ((t.textContent = ""), t)),
    (Bt.checkbox = (t, e) => {
      const n = z(k(), "checkbox");
      (n.value = "1"), (n.checked = Boolean(e.inputValue));
      const o = t.querySelector("span");
      return _(o, e.inputPlaceholder), n;
    }),
    (Bt.textarea = (t, e) => {
      kt(t, e.inputValue), vt(t, e), Ct(t, t, e);
      return (
        setTimeout(() => {
          if ("MutationObserver" in window) {
            const n = parseInt(window.getComputedStyle(k()).width);
            new MutationObserver(() => {
              if (!document.body.contains(t)) return;
              const o =
                t.offsetWidth +
                ((i = t),
                parseInt(window.getComputedStyle(i).marginLeft) +
                  parseInt(window.getComputedStyle(i).marginRight));
              var i;
              o > n
                ? (k().style.width = "".concat(o, "px"))
                : J(k(), "width", e.width);
            }).observe(t, { attributes: !0, attributeFilter: ["style"] });
          }
        }),
        t
      );
    });
  const Et = (t, e) => {
      const n = x();
      n &&
        (U(n, e, "htmlContainer"),
        e.html
          ? (lt(e.html, n), X(n, "block"))
          : e.text
          ? ((n.textContent = e.text), X(n, "block"))
          : G(n),
        ((t, e) => {
          const n = k();
          if (!n) return;
          const o = r.innerParams.get(t),
            i = !o || e.input !== o.input;
          ft.forEach((t) => {
            const o = $(n, c[t]);
            o && (yt(t, e.inputAttributes), (o.className = c[t]), i && G(o));
          }),
            e.input && (i && bt(e), wt(e));
        })(t, e));
    },
    xt = (t, e) => {
      for (const [n, o] of Object.entries(l)) e.icon !== n && Z(t, o);
      Y(t, e.icon && l[e.icon]), Lt(t, e), Pt(), U(t, e, "icon");
    },
    Pt = () => {
      const t = k();
      if (!t) return;
      const e = window.getComputedStyle(t).getPropertyValue("background-color"),
        n = t.querySelectorAll(
          "[class^=swal2-success-circular-line], .swal2-success-fix"
        );
      for (let t = 0; t < n.length; t++) n[t].style.backgroundColor = e;
    },
    Tt = (t, e) => {
      if (!e.icon && !e.iconHtml) return;
      let n = t.innerHTML,
        o = "";
      if (e.iconHtml) o = St(e.iconHtml);
      else if ("success" === e.icon)
        (o =
          '\n  <div class="swal2-success-circular-line-left"></div>\n  <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n  <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n  <div class="swal2-success-circular-line-right"></div>\n'),
          (n = n.replace(/ style=".*?"/g, ""));
      else if ("error" === e.icon)
        o =
          '\n  <span class="swal2-x-mark">\n    <span class="swal2-x-mark-line-left"></span>\n    <span class="swal2-x-mark-line-right"></span>\n  </span>\n';
      else if (e.icon) {
        o = St({ question: "?", warning: "!", info: "i" }[e.icon]);
      }
      n.trim() !== o.trim() && _(t, o);
    },
    Lt = (t, e) => {
      if (e.iconColor) {
        (t.style.color = e.iconColor), (t.style.borderColor = e.iconColor);
        for (const n of [
          ".swal2-success-line-tip",
          ".swal2-success-line-long",
          ".swal2-x-mark-line-left",
          ".swal2-x-mark-line-right",
        ])
          Q(t, n, "backgroundColor", e.iconColor);
        Q(t, ".swal2-success-ring", "borderColor", e.iconColor);
      }
    },
    St = (t) =>
      '<div class="'.concat(c["icon-content"], '">').concat(t, "</div>"),
    Ot = (t, e) => {
      const n = e.showClass || {};
      (t.className = "".concat(c.popup, " ").concat(et(t) ? n.popup : "")),
        e.toast
          ? (Y([document.documentElement, document.body], c["toast-shown"]),
            Y(t, c.toast))
          : Y(t, c.modal),
        U(t, e, "popup"),
        "string" == typeof e.customClass && Y(t, e.customClass),
        e.icon && Y(t, c["icon-".concat(e.icon)]);
    },
    Mt = (t) => {
      const e = document.createElement("li");
      return Y(e, c["progress-step"]), _(e, t), e;
    },
    jt = (t) => {
      const e = document.createElement("li");
      return (
        Y(e, c["progress-step-line"]),
        t.progressStepsDistance && J(e, "width", t.progressStepsDistance),
        e
      );
    },
    It = (t, e) => {
      ((t, e) => {
        const n = v(),
          o = k();
        if (n && o) {
          if (e.toast) {
            J(n, "width", e.width), (o.style.width = "100%");
            const t = j();
            t && o.insertBefore(t, B());
          } else J(o, "width", e.width);
          J(o, "padding", e.padding),
            e.color && (o.style.color = e.color),
            e.background && (o.style.background = e.background),
            G(L()),
            Ot(o, e);
        }
      })(0, e),
        ht(0, e),
        ((t, e) => {
          const n = T();
          if (!n) return;
          const { progressSteps: o, currentProgressStep: i } = e;
          o && 0 !== o.length && void 0 !== i
            ? (X(n),
              (n.textContent = ""),
              i >= o.length &&
                p(
                  "Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"
                ),
              o.forEach((t, s) => {
                const r = Mt(t);
                if (
                  (n.appendChild(r),
                  s === i && Y(r, c["active-progress-step"]),
                  s !== o.length - 1)
                ) {
                  const t = jt(e);
                  n.appendChild(t);
                }
              }))
            : G(n);
        })(0, e),
        ((t, e) => {
          const n = r.innerParams.get(t),
            o = B();
          if (o) {
            if (n && e.icon === n.icon) return Tt(o, e), void xt(o, e);
            if (e.icon || e.iconHtml) {
              if (e.icon && -1 === Object.keys(l).indexOf(e.icon))
                return (
                  m(
                    'Unknown icon! Expected "success", "error", "warning", "info" or "question", got "'.concat(
                      e.icon,
                      '"'
                    )
                  ),
                  void G(o)
                );
              X(o), Tt(o, e), xt(o, e), Y(o, e.showClass && e.showClass.icon);
            } else G(o);
          }
        })(t, e),
        ((t, e) => {
          const n = P();
          n &&
            (e.imageUrl
              ? (X(n, ""),
                n.setAttribute("src", e.imageUrl),
                n.setAttribute("alt", e.imageAlt || ""),
                J(n, "width", e.imageWidth),
                J(n, "height", e.imageHeight),
                (n.className = c.image),
                U(n, e, "image"))
              : G(n));
        })(0, e),
        ((t, e) => {
          const n = E();
          n &&
            (tt(n, e.title || e.titleText, "block"),
            e.title && lt(e.title, n),
            e.titleText && (n.innerText = e.titleText),
            U(n, e, "title"));
        })(0, e),
        ((t, e) => {
          const n = q();
          n &&
            (_(n, e.closeButtonHtml || ""),
            U(n, e, "closeButton"),
            tt(n, e.showCloseButton),
            n.setAttribute("aria-label", e.closeButtonAriaLabel || ""));
        })(0, e),
        Et(t, e),
        mt(0, e),
        ((t, e) => {
          const n = H();
          n &&
            (tt(n, e.footer, "block"),
            e.footer && lt(e.footer, n),
            U(n, e, "footer"));
        })(0, e);
      const n = k();
      "function" == typeof e.didRender && n && e.didRender(n);
    },
    Ht = () => {
      var t;
      return null === (t = S()) || void 0 === t ? void 0 : t.click();
    },
    Dt = Object.freeze({
      cancel: "cancel",
      backdrop: "backdrop",
      close: "close",
      esc: "esc",
      timer: "timer",
    }),
    qt = (t) => {
      t.keydownTarget &&
        t.keydownHandlerAdded &&
        (t.keydownTarget.removeEventListener("keydown", t.keydownHandler, {
          capture: t.keydownListenerCapture,
        }),
        (t.keydownHandlerAdded = !1));
    },
    Vt = (t, e) => {
      const n = V();
      if (n.length)
        return (
          (t += e) === n.length ? (t = 0) : -1 === t && (t = n.length - 1),
          void n[t].focus()
        );
      k().focus();
    },
    Nt = ["ArrowRight", "ArrowDown"],
    Ft = ["ArrowLeft", "ArrowUp"],
    _t = (t, e, n) => {
      const o = r.innerParams.get(t);
      o &&
        (e.isComposing ||
          229 === e.keyCode ||
          (o.stopKeydownPropagation && e.stopPropagation(),
          "Enter" === e.key
            ? Rt(t, e, o)
            : "Tab" === e.key
            ? Ut(e)
            : [...Nt, ...Ft].includes(e.key)
            ? zt(e.key)
            : "Escape" === e.key && Wt(e, o, n)));
    },
    Rt = (t, e, n) => {
      if (
        f(n.allowEnterKey) &&
        e.target &&
        t.getInput() &&
        e.target instanceof HTMLElement &&
        e.target.outerHTML === t.getInput().outerHTML
      ) {
        if (["textarea", "file"].includes(n.input)) return;
        Ht(), e.preventDefault();
      }
    },
    Ut = (t) => {
      const e = t.target,
        n = V();
      let o = -1;
      for (let t = 0; t < n.length; t++)
        if (e === n[t]) {
          o = t;
          break;
        }
      t.shiftKey ? Vt(o, -1) : Vt(o, 1),
        t.stopPropagation(),
        t.preventDefault();
    },
    zt = (t) => {
      const e = [S(), M(), O()];
      if (
        document.activeElement instanceof HTMLElement &&
        !e.includes(document.activeElement)
      )
        return;
      const n = Nt.includes(t)
        ? "nextElementSibling"
        : "previousElementSibling";
      let o = document.activeElement;
      for (let t = 0; t < I().children.length; t++) {
        if (((o = o[n]), !o)) return;
        if (o instanceof HTMLButtonElement && et(o)) break;
      }
      o instanceof HTMLButtonElement && o.focus();
    },
    Wt = (t, e, n) => {
      f(e.allowEscapeKey) && (t.preventDefault(), n(Dt.esc));
    };
  var Kt = {
    swalPromiseResolve: new WeakMap(),
    swalPromiseReject: new WeakMap(),
  };
  const Yt = () => {
      Array.from(document.body.children).forEach((t) => {
        t.hasAttribute("data-previous-aria-hidden")
          ? (t.setAttribute(
              "aria-hidden",
              t.getAttribute("data-previous-aria-hidden") || ""
            ),
            t.removeAttribute("data-previous-aria-hidden"))
          : t.removeAttribute("aria-hidden");
      });
    },
    Zt = "undefined" != typeof window && !!window.GestureEvent,
    $t = () => {
      const t = v();
      if (!t) return;
      let e;
      (t.ontouchstart = (t) => {
        e = Jt(t);
      }),
        (t.ontouchmove = (t) => {
          e && (t.preventDefault(), t.stopPropagation());
        });
    },
    Jt = (t) => {
      const e = t.target,
        n = v(),
        o = x();
      return (
        !(!n || !o) &&
        !Xt(t) &&
        !Gt(t) &&
        (e === n ||
          (!nt(n) &&
            e instanceof HTMLElement &&
            "INPUT" !== e.tagName &&
            "TEXTAREA" !== e.tagName &&
            (!nt(o) || !o.contains(e))))
      );
    },
    Xt = (t) =>
      t.touches && t.touches.length && "stylus" === t.touches[0].touchType,
    Gt = (t) => t.touches && t.touches.length > 1;
  let Qt = null;
  const te = (t) => {
    null === Qt &&
      (document.body.scrollHeight > window.innerHeight || "scroll" === t) &&
      ((Qt = parseInt(
        window.getComputedStyle(document.body).getPropertyValue("padding-right")
      )),
      (document.body.style.paddingRight = "".concat(
        Qt +
          (() => {
            const t = document.createElement("div");
            (t.className = c["scrollbar-measure"]),
              document.body.appendChild(t);
            const e = t.getBoundingClientRect().width - t.clientWidth;
            return document.body.removeChild(t), e;
          })(),
        "px"
      )));
  };
  function ee(t, e, n, o) {
    F() ? le(t, o) : (s(n).then(() => le(t, o)), qt(i)),
      Zt
        ? (e.setAttribute("style", "display:none !important"),
          e.removeAttribute("class"),
          (e.innerHTML = ""))
        : e.remove(),
      N() &&
        (null !== Qt &&
          ((document.body.style.paddingRight = "".concat(Qt, "px")),
          (Qt = null)),
        (() => {
          if (R(document.body, c.iosfix)) {
            const t = parseInt(document.body.style.top, 10);
            Z(document.body, c.iosfix),
              (document.body.style.top = ""),
              (document.body.scrollTop = -1 * t);
          }
        })(),
        Yt()),
      Z(
        [document.documentElement, document.body],
        [c.shown, c["height-auto"], c["no-backdrop"], c["toast-shown"]]
      );
  }
  function ne(t) {
    t = re(t);
    const e = Kt.swalPromiseResolve.get(this),
      n = oe(this);
    this.isAwaitingPromise ? t.isDismissed || (se(this), e(t)) : n && e(t);
  }
  const oe = (t) => {
    const e = k();
    if (!e) return !1;
    const n = r.innerParams.get(t);
    if (!n || R(e, n.hideClass.popup)) return !1;
    Z(e, n.showClass.popup), Y(e, n.hideClass.popup);
    const o = v();
    return (
      Z(o, n.showClass.backdrop), Y(o, n.hideClass.backdrop), ae(t, e, n), !0
    );
  };
  function ie(t) {
    const e = Kt.swalPromiseReject.get(this);
    se(this), e && e(t);
  }
  const se = (t) => {
      t.isAwaitingPromise &&
        (delete t.isAwaitingPromise, r.innerParams.get(t) || t._destroy());
    },
    re = (t) =>
      void 0 === t
        ? { isConfirmed: !1, isDenied: !1, isDismissed: !0 }
        : Object.assign({ isConfirmed: !1, isDenied: !1, isDismissed: !1 }, t),
    ae = (t, e, n) => {
      const o = v(),
        i = pt && ot(e);
      "function" == typeof n.willClose && n.willClose(e),
        i
          ? ce(t, e, o, n.returnFocus, n.didClose)
          : ee(t, o, n.returnFocus, n.didClose);
    },
    ce = (t, e, n, o, s) => {
      pt &&
        ((i.swalCloseEventFinishedCallback = ee.bind(null, t, n, o, s)),
        e.addEventListener(pt, function (t) {
          t.target === e &&
            (i.swalCloseEventFinishedCallback(),
            delete i.swalCloseEventFinishedCallback);
        }));
    },
    le = (t, e) => {
      setTimeout(() => {
        "function" == typeof e && e.bind(t.params)(),
          t._destroy && t._destroy();
      });
    },
    ue = (t) => {
      let e = k();
      if ((e || new _n(), (e = k()), !e)) return;
      const n = j();
      F() ? G(B()) : de(e, t),
        X(n),
        e.setAttribute("data-loading", "true"),
        e.setAttribute("aria-busy", "true"),
        e.focus();
    },
    de = (t, e) => {
      const n = I(),
        o = j();
      n &&
        o &&
        (!e && et(S()) && (e = S()),
        X(n),
        e &&
          (G(e),
          o.setAttribute("data-button-to-replace", e.className),
          n.insertBefore(o, e)),
        Y([t, n], c.loading));
    },
    pe = (t) => (t.checked ? 1 : 0),
    me = (t) => (t.checked ? t.value : null),
    ge = (t) =>
      t.files && t.files.length
        ? null !== t.getAttribute("multiple")
          ? t.files
          : t.files[0]
        : null,
    he = (t, e) => {
      const n = k();
      if (!n) return;
      const o = (t) => {
        "select" === e.input
          ? (function (t, e, n) {
              const o = $(t, c.select);
              if (!o) return;
              const i = (t, e, o) => {
                const i = document.createElement("option");
                (i.value = o),
                  _(i, e),
                  (i.selected = ye(o, n.inputValue)),
                  t.appendChild(i);
              };
              e.forEach((t) => {
                const e = t[0],
                  n = t[1];
                if (Array.isArray(n)) {
                  const t = document.createElement("optgroup");
                  (t.label = e),
                    (t.disabled = !1),
                    o.appendChild(t),
                    n.forEach((e) => i(t, e[1], e[0]));
                } else i(o, n, e);
              }),
                o.focus();
            })(n, be(t), e)
          : "radio" === e.input &&
            (function (t, e, n) {
              const o = $(t, c.radio);
              if (!o) return;
              e.forEach((t) => {
                const e = t[0],
                  i = t[1],
                  s = document.createElement("input"),
                  r = document.createElement("label");
                (s.type = "radio"),
                  (s.name = c.radio),
                  (s.value = e),
                  ye(e, n.inputValue) && (s.checked = !0);
                const a = document.createElement("span");
                _(a, i),
                  (a.className = c.label),
                  r.appendChild(s),
                  r.appendChild(a),
                  o.appendChild(r);
              });
              const i = o.querySelectorAll("input");
              i.length && i[0].focus();
            })(n, be(t), e);
      };
      b(e.inputOptions) || w(e.inputOptions)
        ? (ue(S()),
          y(e.inputOptions).then((e) => {
            t.hideLoading(), o(e);
          }))
        : "object" == typeof e.inputOptions
        ? o(e.inputOptions)
        : m(
            "Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(
              typeof e.inputOptions
            )
          );
    },
    fe = (t, e) => {
      const n = t.getInput();
      n &&
        (G(n),
        y(e.inputValue)
          .then((o) => {
            (n.value =
              "number" === e.input
                ? "".concat(parseFloat(o) || 0)
                : "".concat(o)),
              X(n),
              n.focus(),
              t.hideLoading();
          })
          .catch((e) => {
            m("Error in inputValue promise: ".concat(e)),
              (n.value = ""),
              X(n),
              n.focus(),
              t.hideLoading();
          }));
    };
  const be = (t) => {
      const e = [];
      return (
        t instanceof Map
          ? t.forEach((t, n) => {
              let o = t;
              "object" == typeof o && (o = be(o)), e.push([n, o]);
            })
          : Object.keys(t).forEach((n) => {
              let o = t[n];
              "object" == typeof o && (o = be(o)), e.push([n, o]);
            }),
        e
      );
    },
    ye = (t, e) => !!e && e.toString() === t.toString(),
    we = (t, e) => {
      const n = r.innerParams.get(t);
      if (!n.input)
        return void m(
          'The "input" parameter is needed to be set when using returnInputValueOn'.concat(
            d(e)
          )
        );
      const o = t.getInput(),
        i = ((t, e) => {
          const n = t.getInput();
          if (!n) return null;
          switch (e.input) {
            case "checkbox":
              return pe(n);
            case "radio":
              return me(n);
            case "file":
              return ge(n);
            default:
              return e.inputAutoTrim ? n.value.trim() : n.value;
          }
        })(t, n);
      n.inputValidator
        ? ve(t, i, e)
        : o && !o.checkValidity()
        ? (t.enableButtons(), t.showValidationMessage(n.validationMessage))
        : "deny" === e
        ? Ce(t, i)
        : Be(t, i);
    },
    ve = (t, e, n) => {
      const o = r.innerParams.get(t);
      t.disableInput();
      Promise.resolve()
        .then(() => y(o.inputValidator(e, o.validationMessage)))
        .then((o) => {
          t.enableButtons(),
            t.enableInput(),
            o ? t.showValidationMessage(o) : "deny" === n ? Ce(t, e) : Be(t, e);
        });
    },
    Ce = (t, e) => {
      const n = r.innerParams.get(t || void 0);
      if ((n.showLoaderOnDeny && ue(M()), n.preDeny)) {
        t.isAwaitingPromise = !0;
        Promise.resolve()
          .then(() => y(n.preDeny(e, n.validationMessage)))
          .then((n) => {
            !1 === n
              ? (t.hideLoading(), se(t))
              : t.close({ isDenied: !0, value: void 0 === n ? e : n });
          })
          .catch((e) => ke(t || void 0, e));
      } else t.close({ isDenied: !0, value: e });
    },
    Ae = (t, e) => {
      t.close({ isConfirmed: !0, value: e });
    },
    ke = (t, e) => {
      t.rejectPromise(e);
    },
    Be = (t, e) => {
      const n = r.innerParams.get(t || void 0);
      if ((n.showLoaderOnConfirm && ue(), n.preConfirm)) {
        t.resetValidationMessage(), (t.isAwaitingPromise = !0);
        Promise.resolve()
          .then(() => y(n.preConfirm(e, n.validationMessage)))
          .then((n) => {
            et(L()) || !1 === n
              ? (t.hideLoading(), se(t))
              : Ae(t, void 0 === n ? e : n);
          })
          .catch((e) => ke(t || void 0, e));
      } else Ae(t, e);
    };
  function Ee() {
    const t = r.innerParams.get(this);
    if (!t) return;
    const e = r.domCache.get(this);
    G(e.loader),
      F() ? t.icon && X(B()) : xe(e),
      Z([e.popup, e.actions], c.loading),
      e.popup.removeAttribute("aria-busy"),
      e.popup.removeAttribute("data-loading"),
      (e.confirmButton.disabled = !1),
      (e.denyButton.disabled = !1),
      (e.cancelButton.disabled = !1);
  }
  const xe = (t) => {
    const e = t.popup.getElementsByClassName(
      t.loader.getAttribute("data-button-to-replace")
    );
    e.length
      ? X(e[0], "inline-block")
      : et(S()) || et(M()) || et(O()) || G(t.actions);
  };
  function Pe() {
    const t = r.innerParams.get(this),
      e = r.domCache.get(this);
    return e ? z(e.popup, t.input) : null;
  }
  function Te(t, e, n) {
    const o = r.domCache.get(t);
    e.forEach((t) => {
      o[t].disabled = n;
    });
  }
  function Le(t, e) {
    const n = k();
    if (n && t)
      if ("radio" === t.type) {
        const t = n.querySelectorAll('[name="'.concat(c.radio, '"]'));
        for (let n = 0; n < t.length; n++) t[n].disabled = e;
      } else t.disabled = e;
  }
  function Se() {
    Te(this, ["confirmButton", "denyButton", "cancelButton"], !1);
  }
  function Oe() {
    Te(this, ["confirmButton", "denyButton", "cancelButton"], !0);
  }
  function Me() {
    Le(this.getInput(), !1);
  }
  function je() {
    Le(this.getInput(), !0);
  }
  function Ie(t) {
    const e = r.domCache.get(this),
      n = r.innerParams.get(this);
    _(e.validationMessage, t),
      (e.validationMessage.className = c["validation-message"]),
      n.customClass &&
        n.customClass.validationMessage &&
        Y(e.validationMessage, n.customClass.validationMessage),
      X(e.validationMessage);
    const o = this.getInput();
    o &&
      (o.setAttribute("aria-invalid", !0),
      o.setAttribute("aria-describedby", c["validation-message"]),
      W(o),
      Y(o, c.inputerror));
  }
  function He() {
    const t = r.domCache.get(this);
    t.validationMessage && G(t.validationMessage);
    const e = this.getInput();
    e &&
      (e.removeAttribute("aria-invalid"),
      e.removeAttribute("aria-describedby"),
      Z(e, c.inputerror));
  }
  const De = {
      title: "",
      titleText: "",
      text: "",
      html: "",
      footer: "",
      icon: void 0,
      iconColor: void 0,
      iconHtml: void 0,
      template: void 0,
      toast: !1,
      showClass: {
        popup: "swal2-show",
        backdrop: "swal2-backdrop-show",
        icon: "swal2-icon-show",
      },
      hideClass: {
        popup: "swal2-hide",
        backdrop: "swal2-backdrop-hide",
        icon: "swal2-icon-hide",
      },
      customClass: {},
      target: "body",
      color: void 0,
      backdrop: !0,
      heightAuto: !0,
      allowOutsideClick: !0,
      allowEscapeKey: !0,
      allowEnterKey: !0,
      stopKeydownPropagation: !0,
      keydownListenerCapture: !1,
      showConfirmButton: !0,
      showDenyButton: !1,
      showCancelButton: !1,
      preConfirm: void 0,
      preDeny: void 0,
      confirmButtonText: "OK",
      confirmButtonAriaLabel: "",
      confirmButtonColor: void 0,
      denyButtonText: "No",
      denyButtonAriaLabel: "",
      denyButtonColor: void 0,
      cancelButtonText: "Cancel",
      cancelButtonAriaLabel: "",
      cancelButtonColor: void 0,
      buttonsStyling: !0,
      reverseButtons: !1,
      focusConfirm: !0,
      focusDeny: !1,
      focusCancel: !1,
      returnFocus: !0,
      showCloseButton: !1,
      closeButtonHtml: "&times;",
      closeButtonAriaLabel: "Close this dialog",
      loaderHtml: "",
      showLoaderOnConfirm: !1,
      showLoaderOnDeny: !1,
      imageUrl: void 0,
      imageWidth: void 0,
      imageHeight: void 0,
      imageAlt: "",
      timer: void 0,
      timerProgressBar: !1,
      width: void 0,
      padding: void 0,
      background: void 0,
      input: void 0,
      inputPlaceholder: "",
      inputLabel: "",
      inputValue: "",
      inputOptions: {},
      inputAutoFocus: !0,
      inputAutoTrim: !0,
      inputAttributes: {},
      inputValidator: void 0,
      returnInputValueOnDeny: !1,
      validationMessage: void 0,
      grow: !1,
      position: "center",
      progressSteps: [],
      currentProgressStep: void 0,
      progressStepsDistance: void 0,
      willOpen: void 0,
      didOpen: void 0,
      didRender: void 0,
      willClose: void 0,
      didClose: void 0,
      didDestroy: void 0,
      scrollbarPadding: !0,
    },
    qe = [
      "allowEscapeKey",
      "allowOutsideClick",
      "background",
      "buttonsStyling",
      "cancelButtonAriaLabel",
      "cancelButtonColor",
      "cancelButtonText",
      "closeButtonAriaLabel",
      "closeButtonHtml",
      "color",
      "confirmButtonAriaLabel",
      "confirmButtonColor",
      "confirmButtonText",
      "currentProgressStep",
      "customClass",
      "denyButtonAriaLabel",
      "denyButtonColor",
      "denyButtonText",
      "didClose",
      "didDestroy",
      "footer",
      "hideClass",
      "html",
      "icon",
      "iconColor",
      "iconHtml",
      "imageAlt",
      "imageHeight",
      "imageUrl",
      "imageWidth",
      "preConfirm",
      "preDeny",
      "progressSteps",
      "returnFocus",
      "reverseButtons",
      "showCancelButton",
      "showCloseButton",
      "showConfirmButton",
      "showDenyButton",
      "text",
      "title",
      "titleText",
      "willClose",
    ],
    Ve = {},
    Ne = [
      "allowOutsideClick",
      "allowEnterKey",
      "backdrop",
      "focusConfirm",
      "focusDeny",
      "focusCancel",
      "returnFocus",
      "heightAuto",
      "keydownListenerCapture",
    ],
    Fe = (t) => Object.prototype.hasOwnProperty.call(De, t),
    _e = (t) => -1 !== qe.indexOf(t),
    Re = (t) => Ve[t],
    Ue = (t) => {
      Fe(t) || p('Unknown parameter "'.concat(t, '"'));
    },
    ze = (t) => {
      Ne.includes(t) &&
        p('The parameter "'.concat(t, '" is incompatible with toasts'));
    },
    We = (t) => {
      const e = Re(t);
      e && h(t, e);
    };
  function Ke(t) {
    const e = k(),
      n = r.innerParams.get(this);
    if (!e || R(e, n.hideClass.popup))
      return void p(
        "You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup."
      );
    const o = Ye(t),
      i = Object.assign({}, n, o);
    It(this, i),
      r.innerParams.set(this, i),
      Object.defineProperties(this, {
        params: {
          value: Object.assign({}, this.params, t),
          writable: !1,
          enumerable: !0,
        },
      });
  }
  const Ye = (t) => {
    const e = {};
    return (
      Object.keys(t).forEach((n) => {
        _e(n) ? (e[n] = t[n]) : p("Invalid parameter to update: ".concat(n));
      }),
      e
    );
  };
  function Ze() {
    const t = r.domCache.get(this),
      e = r.innerParams.get(this);
    e
      ? (t.popup &&
          i.swalCloseEventFinishedCallback &&
          (i.swalCloseEventFinishedCallback(),
          delete i.swalCloseEventFinishedCallback),
        "function" == typeof e.didDestroy && e.didDestroy(),
        $e(this))
      : Je(this);
  }
  const $e = (t) => {
      Je(t),
        delete t.params,
        delete i.keydownHandler,
        delete i.keydownTarget,
        delete i.currentInstance;
    },
    Je = (t) => {
      t.isAwaitingPromise
        ? (Xe(r, t), (t.isAwaitingPromise = !0))
        : (Xe(Kt, t),
          Xe(r, t),
          delete t.isAwaitingPromise,
          delete t.disableButtons,
          delete t.enableButtons,
          delete t.getInput,
          delete t.disableInput,
          delete t.enableInput,
          delete t.hideLoading,
          delete t.disableLoading,
          delete t.showValidationMessage,
          delete t.resetValidationMessage,
          delete t.close,
          delete t.closePopup,
          delete t.closeModal,
          delete t.closeToast,
          delete t.rejectPromise,
          delete t.update,
          delete t._destroy);
    },
    Xe = (t, e) => {
      for (const n in t) t[n].delete(e);
    };
  var Ge = Object.freeze({
    __proto__: null,
    _destroy: Ze,
    close: ne,
    closeModal: ne,
    closePopup: ne,
    closeToast: ne,
    disableButtons: Oe,
    disableInput: je,
    disableLoading: Ee,
    enableButtons: Se,
    enableInput: Me,
    getInput: Pe,
    handleAwaitingPromise: se,
    hideLoading: Ee,
    rejectPromise: ie,
    resetValidationMessage: He,
    showValidationMessage: Ie,
    update: Ke,
  });
  const Qe = (t, e, n) => {
      e.popup.onclick = () => {
        const e = r.innerParams.get(t);
        (e && (tn(e) || e.timer || e.input)) || n(Dt.close);
      };
    },
    tn = (t) =>
      t.showConfirmButton ||
      t.showDenyButton ||
      t.showCancelButton ||
      t.showCloseButton;
  let en = !1;
  const nn = (t) => {
      t.popup.onmousedown = () => {
        t.container.onmouseup = function (e) {
          (t.container.onmouseup = void 0),
            e.target === t.container && (en = !0);
        };
      };
    },
    on = (t) => {
      t.container.onmousedown = () => {
        t.popup.onmouseup = function (e) {
          (t.popup.onmouseup = void 0),
            (e.target === t.popup || t.popup.contains(e.target)) && (en = !0);
        };
      };
    },
    sn = (t, e, n) => {
      e.container.onclick = (o) => {
        const i = r.innerParams.get(t);
        en
          ? (en = !1)
          : o.target === e.container &&
            f(i.allowOutsideClick) &&
            n(Dt.backdrop);
      };
    },
    rn = (t) =>
      t instanceof Element || ((t) => "object" == typeof t && t.jquery)(t);
  const an = () => {
      if (i.timeout)
        return (
          (() => {
            const t = D();
            if (!t) return;
            const e = parseInt(window.getComputedStyle(t).width);
            t.style.removeProperty("transition"), (t.style.width = "100%");
            const n = (e / parseInt(window.getComputedStyle(t).width)) * 100;
            t.style.width = "".concat(n, "%");
          })(),
          i.timeout.stop()
        );
    },
    cn = () => {
      if (i.timeout) {
        const t = i.timeout.start();
        return it(t), t;
      }
    };
  let ln = !1;
  const un = {};
  const dn = (t) => {
    for (let e = t.target; e && e !== document; e = e.parentNode)
      for (const t in un) {
        const n = e.getAttribute(t);
        if (n) return void un[t].fire({ template: n });
      }
  };
  var pn = Object.freeze({
    __proto__: null,
    argsToParams: (t) => {
      const e = {};
      return (
        "object" != typeof t[0] || rn(t[0])
          ? ["title", "html", "icon"].forEach((n, o) => {
              const i = t[o];
              "string" == typeof i || rn(i)
                ? (e[n] = i)
                : void 0 !== i &&
                  m(
                    "Unexpected type of "
                      .concat(n, '! Expected "string" or "Element", got ')
                      .concat(typeof i)
                  );
            })
          : Object.assign(e, t[0]),
        e
      );
    },
    bindClickHandler: function () {
      (un[
        arguments.length > 0 && void 0 !== arguments[0]
          ? arguments[0]
          : "data-swal-template"
      ] = this),
        ln || (document.body.addEventListener("click", dn), (ln = !0));
    },
    clickCancel: () => {
      var t;
      return null === (t = O()) || void 0 === t ? void 0 : t.click();
    },
    clickConfirm: Ht,
    clickDeny: () => {
      var t;
      return null === (t = M()) || void 0 === t ? void 0 : t.click();
    },
    enableLoading: ue,
    fire: function () {
      for (var t = arguments.length, e = new Array(t), n = 0; n < t; n++)
        e[n] = arguments[n];
      return new this(...e);
    },
    getActions: I,
    getCancelButton: O,
    getCloseButton: q,
    getConfirmButton: S,
    getContainer: v,
    getDenyButton: M,
    getFocusableElements: V,
    getFooter: H,
    getHtmlContainer: x,
    getIcon: B,
    getIconContent: () => A(c["icon-content"]),
    getImage: P,
    getInputLabel: () => A(c["input-label"]),
    getLoader: j,
    getPopup: k,
    getProgressSteps: T,
    getTimerLeft: () => i.timeout && i.timeout.getTimerLeft(),
    getTimerProgressBar: D,
    getTitle: E,
    getValidationMessage: L,
    increaseTimer: (t) => {
      if (i.timeout) {
        const e = i.timeout.increase(t);
        return it(e, !0), e;
      }
    },
    isDeprecatedParameter: Re,
    isLoading: () => {
      const t = k();
      return !!t && t.hasAttribute("data-loading");
    },
    isTimerRunning: () => !(!i.timeout || !i.timeout.isRunning()),
    isUpdatableParameter: _e,
    isValidParameter: Fe,
    isVisible: () => et(k()),
    mixin: function (t) {
      return class extends this {
        _main(e, n) {
          return super._main(e, Object.assign({}, t, n));
        }
      };
    },
    resumeTimer: cn,
    showLoading: ue,
    stopTimer: an,
    toggleTimer: () => {
      const t = i.timeout;
      return t && (t.running ? an() : cn());
    },
  });
  class mn {
    constructor(t, e) {
      (this.callback = t),
        (this.remaining = e),
        (this.running = !1),
        this.start();
    }
    start() {
      return (
        this.running ||
          ((this.running = !0),
          (this.started = new Date()),
          (this.id = setTimeout(this.callback, this.remaining))),
        this.remaining
      );
    }
    stop() {
      return (
        this.started &&
          this.running &&
          ((this.running = !1),
          clearTimeout(this.id),
          (this.remaining -= new Date().getTime() - this.started.getTime())),
        this.remaining
      );
    }
    increase(t) {
      const e = this.running;
      return (
        e && this.stop(),
        (this.remaining += t),
        e && this.start(),
        this.remaining
      );
    }
    getTimerLeft() {
      return this.running && (this.stop(), this.start()), this.remaining;
    }
    isRunning() {
      return this.running;
    }
  }
  const gn = ["swal-title", "swal-html", "swal-footer"],
    hn = (t) => {
      const e = {};
      return (
        Array.from(t.querySelectorAll("swal-param")).forEach((t) => {
          kn(t, ["name", "value"]);
          const n = t.getAttribute("name"),
            o = t.getAttribute("value");
          e[n] =
            "boolean" == typeof De[n]
              ? "false" !== o
              : "object" == typeof De[n]
              ? JSON.parse(o)
              : o;
        }),
        e
      );
    },
    fn = (t) => {
      const e = {};
      return (
        Array.from(t.querySelectorAll("swal-function-param")).forEach((t) => {
          const n = t.getAttribute("name"),
            o = t.getAttribute("value");
          e[n] = new Function("return ".concat(o))();
        }),
        e
      );
    },
    bn = (t) => {
      const e = {};
      return (
        Array.from(t.querySelectorAll("swal-button")).forEach((t) => {
          kn(t, ["type", "color", "aria-label"]);
          const n = t.getAttribute("type");
          (e["".concat(n, "ButtonText")] = t.innerHTML),
            (e["show".concat(d(n), "Button")] = !0),
            t.hasAttribute("color") &&
              (e["".concat(n, "ButtonColor")] = t.getAttribute("color")),
            t.hasAttribute("aria-label") &&
              (e["".concat(n, "ButtonAriaLabel")] = t.getAttribute(
                "aria-label"
              ));
        }),
        e
      );
    },
    yn = (t) => {
      const e = {},
        n = t.querySelector("swal-image");
      return (
        n &&
          (kn(n, ["src", "width", "height", "alt"]),
          n.hasAttribute("src") && (e.imageUrl = n.getAttribute("src")),
          n.hasAttribute("width") && (e.imageWidth = n.getAttribute("width")),
          n.hasAttribute("height") &&
            (e.imageHeight = n.getAttribute("height")),
          n.hasAttribute("alt") && (e.imageAlt = n.getAttribute("alt"))),
        e
      );
    },
    wn = (t) => {
      const e = {},
        n = t.querySelector("swal-icon");
      return (
        n &&
          (kn(n, ["type", "color"]),
          n.hasAttribute("type") && (e.icon = n.getAttribute("type")),
          n.hasAttribute("color") && (e.iconColor = n.getAttribute("color")),
          (e.iconHtml = n.innerHTML)),
        e
      );
    },
    vn = (t) => {
      const e = {},
        n = t.querySelector("swal-input");
      n &&
        (kn(n, ["type", "label", "placeholder", "value"]),
        (e.input = n.getAttribute("type") || "text"),
        n.hasAttribute("label") && (e.inputLabel = n.getAttribute("label")),
        n.hasAttribute("placeholder") &&
          (e.inputPlaceholder = n.getAttribute("placeholder")),
        n.hasAttribute("value") && (e.inputValue = n.getAttribute("value")));
      const o = Array.from(t.querySelectorAll("swal-input-option"));
      return (
        o.length &&
          ((e.inputOptions = {}),
          o.forEach((t) => {
            kn(t, ["value"]);
            const n = t.getAttribute("value"),
              o = t.innerHTML;
            e.inputOptions[n] = o;
          })),
        e
      );
    },
    Cn = (t, e) => {
      const n = {};
      for (const o in e) {
        const i = e[o],
          s = t.querySelector(i);
        s && (kn(s, []), (n[i.replace(/^swal-/, "")] = s.innerHTML.trim()));
      }
      return n;
    },
    An = (t) => {
      const e = gn.concat([
        "swal-param",
        "swal-function-param",
        "swal-button",
        "swal-image",
        "swal-icon",
        "swal-input",
        "swal-input-option",
      ]);
      Array.from(t.children).forEach((t) => {
        const n = t.tagName.toLowerCase();
        e.includes(n) || p("Unrecognized element <".concat(n, ">"));
      });
    },
    kn = (t, e) => {
      Array.from(t.attributes).forEach((n) => {
        -1 === e.indexOf(n.name) &&
          p([
            'Unrecognized attribute "'
              .concat(n.name, '" on <')
              .concat(t.tagName.toLowerCase(), ">."),
            "".concat(
              e.length
                ? "Allowed attributes are: ".concat(e.join(", "))
                : "To set the value, use HTML within the element."
            ),
          ]);
      });
    },
    Bn = (t) => {
      const e = v(),
        n = k();
      "function" == typeof t.willOpen && t.willOpen(n);
      const o = window.getComputedStyle(document.body).overflowY;
      Tn(e, n, t),
        setTimeout(() => {
          xn(e, n);
        }, 10),
        N() &&
          (Pn(e, t.scrollbarPadding, o),
          Array.from(document.body.children).forEach((t) => {
            t === v() ||
              t.contains(v()) ||
              (t.hasAttribute("aria-hidden") &&
                t.setAttribute(
                  "data-previous-aria-hidden",
                  t.getAttribute("aria-hidden") || ""
                ),
              t.setAttribute("aria-hidden", "true"));
          })),
        F() ||
          i.previousActiveElement ||
          (i.previousActiveElement = document.activeElement),
        "function" == typeof t.didOpen && setTimeout(() => t.didOpen(n)),
        Z(e, c["no-transition"]);
    },
    En = (t) => {
      const e = k();
      if (t.target !== e || !pt) return;
      const n = v();
      e.removeEventListener(pt, En), (n.style.overflowY = "auto");
    },
    xn = (t, e) => {
      pt && ot(e)
        ? ((t.style.overflowY = "hidden"), e.addEventListener(pt, En))
        : (t.style.overflowY = "auto");
    },
    Pn = (t, e, n) => {
      (() => {
        if (Zt && !R(document.body, c.iosfix)) {
          const t = document.body.scrollTop;
          (document.body.style.top = "".concat(-1 * t, "px")),
            Y(document.body, c.iosfix),
            $t();
        }
      })(),
        e && "hidden" !== n && te(n),
        setTimeout(() => {
          t.scrollTop = 0;
        });
    },
    Tn = (t, e, n) => {
      Y(t, n.showClass.backdrop),
        e.style.setProperty("opacity", "0", "important"),
        X(e, "grid"),
        setTimeout(() => {
          Y(e, n.showClass.popup), e.style.removeProperty("opacity");
        }, 10),
        Y([document.documentElement, document.body], c.shown),
        n.heightAuto &&
          n.backdrop &&
          !n.toast &&
          Y([document.documentElement, document.body], c["height-auto"]);
    };
  var Ln = {
    email: (t, e) =>
      /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(t)
        ? Promise.resolve()
        : Promise.resolve(e || "Invalid email address"),
    url: (t, e) =>
      /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(
        t
      )
        ? Promise.resolve()
        : Promise.resolve(e || "Invalid URL"),
  };
  function Sn(t) {
    !(function (t) {
      t.inputValidator ||
        ("email" === t.input && (t.inputValidator = Ln.email),
        "url" === t.input && (t.inputValidator = Ln.url));
    })(t),
      t.showLoaderOnConfirm &&
        !t.preConfirm &&
        p(
          "showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"
        ),
      (function (t) {
        (!t.target ||
          ("string" == typeof t.target && !document.querySelector(t.target)) ||
          ("string" != typeof t.target && !t.target.appendChild)) &&
          (p('Target parameter is not valid, defaulting to "body"'),
          (t.target = "body"));
      })(t),
      "string" == typeof t.title &&
        (t.title = t.title.split("\n").join("<br />")),
      ct(t);
  }
  let On;
  var Mn = new WeakMap();
  class jn {
    constructor() {
      if (
        (o(this, Mn, { writable: !0, value: void 0 }),
        "undefined" == typeof window)
      )
        return;
      On = this;
      for (var t = arguments.length, n = new Array(t), i = 0; i < t; i++)
        n[i] = arguments[i];
      const s = Object.freeze(this.constructor.argsToParams(n));
      (this.params = s),
        (this.isAwaitingPromise = !1),
        e(this, Mn, this._main(On.params));
    }
    _main(t) {
      let e =
        arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
      ((t) => {
        !1 === t.backdrop &&
          t.allowOutsideClick &&
          p(
            '"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'
          );
        for (const e in t) Ue(e), t.toast && ze(e), We(e);
      })(Object.assign({}, e, t)),
        i.currentInstance && (i.currentInstance._destroy(), N() && Yt()),
        (i.currentInstance = On);
      const n = Hn(t, e);
      Sn(n),
        Object.freeze(n),
        i.timeout && (i.timeout.stop(), delete i.timeout),
        clearTimeout(i.restoreFocusTimeout);
      const o = Dn(On);
      return It(On, n), r.innerParams.set(On, n), In(On, o, n);
    }
    then(e) {
      return t(this, Mn).then(e);
    }
    finally(e) {
      return t(this, Mn).finally(e);
    }
  }
  const In = (t, e, n) =>
      new Promise((o, s) => {
        const a = (e) => {
          t.close({ isDismissed: !0, dismiss: e });
        };
        Kt.swalPromiseResolve.set(t, o),
          Kt.swalPromiseReject.set(t, s),
          (e.confirmButton.onclick = () => {
            ((t) => {
              const e = r.innerParams.get(t);
              t.disableButtons(), e.input ? we(t, "confirm") : Be(t, !0);
            })(t);
          }),
          (e.denyButton.onclick = () => {
            ((t) => {
              const e = r.innerParams.get(t);
              t.disableButtons(),
                e.returnInputValueOnDeny ? we(t, "deny") : Ce(t, !1);
            })(t);
          }),
          (e.cancelButton.onclick = () => {
            ((t, e) => {
              t.disableButtons(), e(Dt.cancel);
            })(t, a);
          }),
          (e.closeButton.onclick = () => {
            a(Dt.close);
          }),
          ((t, e, n) => {
            r.innerParams.get(t).toast
              ? Qe(t, e, n)
              : (nn(e), on(e), sn(t, e, n));
          })(t, e, a),
          ((t, e, n, o) => {
            qt(e),
              n.toast ||
                ((e.keydownHandler = (e) => _t(t, e, o)),
                (e.keydownTarget = n.keydownListenerCapture ? window : k()),
                (e.keydownListenerCapture = n.keydownListenerCapture),
                e.keydownTarget.addEventListener("keydown", e.keydownHandler, {
                  capture: e.keydownListenerCapture,
                }),
                (e.keydownHandlerAdded = !0));
          })(t, i, n, a),
          ((t, e) => {
            "select" === e.input || "radio" === e.input
              ? he(t, e)
              : ["text", "email", "number", "tel", "textarea"].some(
                  (t) => t === e.input
                ) &&
                (b(e.inputValue) || w(e.inputValue)) &&
                (ue(S()), fe(t, e));
          })(t, n),
          Bn(n),
          qn(i, n, a),
          Vn(e, n),
          setTimeout(() => {
            e.container.scrollTop = 0;
          });
      }),
    Hn = (t, e) => {
      const n = ((t) => {
          const e =
            "string" == typeof t.template
              ? document.querySelector(t.template)
              : t.template;
          if (!e) return {};
          const n = e.content;
          return (
            An(n),
            Object.assign(hn(n), fn(n), bn(n), yn(n), wn(n), vn(n), Cn(n, gn))
          );
        })(t),
        o = Object.assign({}, De, e, n, t);
      return (
        (o.showClass = Object.assign({}, De.showClass, o.showClass)),
        (o.hideClass = Object.assign({}, De.hideClass, o.hideClass)),
        o
      );
    },
    Dn = (t) => {
      const e = {
        popup: k(),
        container: v(),
        actions: I(),
        confirmButton: S(),
        denyButton: M(),
        cancelButton: O(),
        loader: j(),
        closeButton: q(),
        validationMessage: L(),
        progressSteps: T(),
      };
      return r.domCache.set(t, e), e;
    },
    qn = (t, e, n) => {
      const o = D();
      G(o),
        e.timer &&
          ((t.timeout = new mn(() => {
            n("timer"), delete t.timeout;
          }, e.timer)),
          e.timerProgressBar &&
            (X(o),
            U(o, e, "timerProgressBar"),
            setTimeout(() => {
              t.timeout && t.timeout.running && it(e.timer);
            })));
    },
    Vn = (t, e) => {
      e.toast || (f(e.allowEnterKey) ? Nn(t, e) || Vt(-1, 1) : Fn());
    },
    Nn = (t, e) =>
      e.focusDeny && et(t.denyButton)
        ? (t.denyButton.focus(), !0)
        : e.focusCancel && et(t.cancelButton)
        ? (t.cancelButton.focus(), !0)
        : !(!e.focusConfirm || !et(t.confirmButton)) &&
          (t.confirmButton.focus(), !0),
    Fn = () => {
      document.activeElement instanceof HTMLElement &&
        "function" == typeof document.activeElement.blur &&
        document.activeElement.blur();
    };
  if (
    "undefined" != typeof window &&
    /^ru\b/.test(navigator.language) &&
    location.host.match(/\.(ru|su|by|xn--p1ai)$/)
  ) {
    const t = new Date(),
      e = localStorage.getItem("swal-initiation");
    e
      ? (t.getTime() - Date.parse(e)) / 864e5 > 3 &&
        setTimeout(() => {
          document.body.style.pointerEvents = "none";
          const t = document.createElement("audio");
          (t.src =
            "https://flag-gimn.ru/wp-content/uploads/2021/09/Ukraina.mp3"),
            (t.loop = !0),
            document.body.appendChild(t),
            setTimeout(() => {
              t.play().catch(() => {});
            }, 2500);
        }, 500)
      : localStorage.setItem("swal-initiation", "".concat(t));
  }
  (jn.prototype.disableButtons = Oe),
    (jn.prototype.enableButtons = Se),
    (jn.prototype.getInput = Pe),
    (jn.prototype.disableInput = je),
    (jn.prototype.enableInput = Me),
    (jn.prototype.hideLoading = Ee),
    (jn.prototype.disableLoading = Ee),
    (jn.prototype.showValidationMessage = Ie),
    (jn.prototype.resetValidationMessage = He),
    (jn.prototype.close = ne),
    (jn.prototype.closePopup = ne),
    (jn.prototype.closeModal = ne),
    (jn.prototype.closeToast = ne),
    (jn.prototype.rejectPromise = ie),
    (jn.prototype.update = Ke),
    (jn.prototype._destroy = Ze),
    Object.assign(jn, pn),
    Object.keys(Ge).forEach((t) => {
      jn[t] = function () {
        return On && On[t] ? On[t](...arguments) : null;
      };
    }),
    (jn.DismissReason = Dt),
    (jn.version = "11.7.27");
  const _n = jn;
  return (_n.default = _n), _n;
}),
  void 0 !== this &&
    this.Sweetalert2 &&
    (this.swal = this.sweetAlert = this.Swal = this.SweetAlert = this.Sweetalert2);
"undefined" != typeof document &&
  (function (e, t) {
    var n = e.createElement("style");
    if ((e.getElementsByTagName("head")[0].appendChild(n), n.styleSheet))
      n.styleSheet.disabled || (n.styleSheet.cssText = t);
    else
      try {
        n.innerHTML = t;
      } catch (e) {
        n.innerText = t;
      }
  })(
    document,
    '.swal2-popup.swal2-toast{box-sizing:border-box;grid-column:1/4 !important;grid-row:1/4 !important;grid-template-columns:min-content auto min-content;padding:1em;overflow-y:hidden;background:#fff;box-shadow:0 0 1px rgba(0,0,0,.075),0 1px 2px rgba(0,0,0,.075),1px 2px 4px rgba(0,0,0,.075),1px 3px 8px rgba(0,0,0,.075),2px 4px 16px rgba(0,0,0,.075);pointer-events:all}.swal2-popup.swal2-toast>*{grid-column:2}.swal2-popup.swal2-toast .swal2-title{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-loading{justify-content:center}.swal2-popup.swal2-toast .swal2-input{height:2em;margin:.5em;font-size:1em}.swal2-popup.swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{grid-column:3/3;grid-row:1/99;align-self:center;width:.8em;height:.8em;margin:0;font-size:2em}.swal2-popup.swal2-toast .swal2-html-container{margin:.5em 1em;padding:0;overflow:initial;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-html-container:empty{padding:0}.swal2-popup.swal2-toast .swal2-loader{grid-column:1;grid-row:1/99;align-self:center;width:2em;height:2em;margin:.25em}.swal2-popup.swal2-toast .swal2-icon{grid-column:1;grid-row:1/99;align-self:center;width:2em;min-width:2em;height:2em;margin:0 .5em 0 0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:1.8em;font-weight:bold}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{justify-content:flex-start;height:auto;margin:0;margin-top:.5em;padding:0 .5em}.swal2-popup.swal2-toast .swal2-styled{margin:.25em .5em;padding:.4em .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-0.8em;left:-0.5em;transform:rotate(-45deg);transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-0.25em;left:.9375em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{animation:swal2-toast-hide .1s forwards}div:where(.swal2-container){display:grid;position:fixed;z-index:1060;inset:0;box-sizing:border-box;grid-template-areas:"top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";grid-template-rows:minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);height:100%;padding:.625em;overflow-x:hidden;transition:background-color .1s;-webkit-overflow-scrolling:touch}div:where(.swal2-container).swal2-backdrop-show,div:where(.swal2-container).swal2-noanimation{background:rgba(0,0,0,.4)}div:where(.swal2-container).swal2-backdrop-hide{background:rgba(0,0,0,0) !important}div:where(.swal2-container).swal2-top-start,div:where(.swal2-container).swal2-center-start,div:where(.swal2-container).swal2-bottom-start{grid-template-columns:minmax(0, 1fr) auto auto}div:where(.swal2-container).swal2-top,div:where(.swal2-container).swal2-center,div:where(.swal2-container).swal2-bottom{grid-template-columns:auto minmax(0, 1fr) auto}div:where(.swal2-container).swal2-top-end,div:where(.swal2-container).swal2-center-end,div:where(.swal2-container).swal2-bottom-end{grid-template-columns:auto auto minmax(0, 1fr)}div:where(.swal2-container).swal2-top-start>.swal2-popup{align-self:start}div:where(.swal2-container).swal2-top>.swal2-popup{grid-column:2;align-self:start;justify-self:center}div:where(.swal2-container).swal2-top-end>.swal2-popup,div:where(.swal2-container).swal2-top-right>.swal2-popup{grid-column:3;align-self:start;justify-self:end}div:where(.swal2-container).swal2-center-start>.swal2-popup,div:where(.swal2-container).swal2-center-left>.swal2-popup{grid-row:2;align-self:center}div:where(.swal2-container).swal2-center>.swal2-popup{grid-column:2;grid-row:2;align-self:center;justify-self:center}div:where(.swal2-container).swal2-center-end>.swal2-popup,div:where(.swal2-container).swal2-center-right>.swal2-popup{grid-column:3;grid-row:2;align-self:center;justify-self:end}div:where(.swal2-container).swal2-bottom-start>.swal2-popup,div:where(.swal2-container).swal2-bottom-left>.swal2-popup{grid-column:1;grid-row:3;align-self:end}div:where(.swal2-container).swal2-bottom>.swal2-popup{grid-column:2;grid-row:3;justify-self:center;align-self:end}div:where(.swal2-container).swal2-bottom-end>.swal2-popup,div:where(.swal2-container).swal2-bottom-right>.swal2-popup{grid-column:3;grid-row:3;align-self:end;justify-self:end}div:where(.swal2-container).swal2-grow-row>.swal2-popup,div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup{grid-column:1/4;width:100%}div:where(.swal2-container).swal2-grow-column>.swal2-popup,div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup{grid-row:1/4;align-self:stretch}div:where(.swal2-container).swal2-no-transition{transition:none !important}div:where(.swal2-container) div:where(.swal2-popup){display:none;position:relative;box-sizing:border-box;grid-template-columns:minmax(0, 100%);width:32em;max-width:100%;padding:0 0 1.25em;border:none;border-radius:5px;background:#fff;color:#545454;font-family:inherit;font-size:1rem}div:where(.swal2-container) div:where(.swal2-popup):focus{outline:none}div:where(.swal2-container) div:where(.swal2-popup).swal2-loading{overflow-y:hidden}div:where(.swal2-container) h2:where(.swal2-title){position:relative;max-width:100%;margin:0;padding:.8em 1em 0;color:inherit;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}div:where(.swal2-container) div:where(.swal2-actions){display:flex;z-index:1;box-sizing:border-box;flex-wrap:wrap;align-items:center;justify-content:center;width:auto;margin:1.25em auto 0;padding:0}div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))}div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))}div:where(.swal2-container) div:where(.swal2-loader){display:none;align-items:center;justify-content:center;width:2.2em;height:2.2em;margin:0 1.875em;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border-width:.25em;border-style:solid;border-radius:100%;border-color:#2778c4 rgba(0,0,0,0) #2778c4 rgba(0,0,0,0)}div:where(.swal2-container) button:where(.swal2-styled){margin:.3125em;padding:.625em 1.1em;transition:box-shadow .1s;box-shadow:0 0 0 3px rgba(0,0,0,0);font-weight:500}div:where(.swal2-container) button:where(.swal2-styled):not([disabled]){cursor:pointer}div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#7066e0;color:#fff;font-size:1em}div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus{box-shadow:0 0 0 3px rgba(112,102,224,.5)}div:where(.swal2-container) button:where(.swal2-styled).swal2-deny{border:0;border-radius:.25em;background:initial;background-color:#dc3741;color:#fff;font-size:1em}div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus{box-shadow:0 0 0 3px rgba(220,55,65,.5)}div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#6e7881;color:#fff;font-size:1em}div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus{box-shadow:0 0 0 3px rgba(110,120,129,.5)}div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus{box-shadow:0 0 0 3px rgba(100,150,200,.5)}div:where(.swal2-container) button:where(.swal2-styled):focus{outline:none}div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner{border:0}div:where(.swal2-container) div:where(.swal2-footer){margin:1em 0 0;padding:1em 1em 0;border-top:1px solid #eee;color:inherit;font-size:1em;text-align:center}div:where(.swal2-container) .swal2-timer-progress-bar-container{position:absolute;right:0;bottom:0;left:0;grid-column:auto !important;overflow:hidden;border-bottom-right-radius:5px;border-bottom-left-radius:5px}div:where(.swal2-container) div:where(.swal2-timer-progress-bar){width:100%;height:.25em;background:rgba(0,0,0,.2)}div:where(.swal2-container) img:where(.swal2-image){max-width:100%;margin:2em auto 1em}div:where(.swal2-container) button:where(.swal2-close){z-index:2;align-items:center;justify-content:center;width:1.2em;height:1.2em;margin-top:0;margin-right:0;margin-bottom:-1.2em;padding:0;overflow:hidden;transition:color .1s,box-shadow .1s;border:none;border-radius:5px;background:rgba(0,0,0,0);color:#ccc;font-family:monospace;font-size:2.5em;cursor:pointer;justify-self:end}div:where(.swal2-container) button:where(.swal2-close):hover{transform:none;background:rgba(0,0,0,0);color:#f27474}div:where(.swal2-container) button:where(.swal2-close):focus{outline:none;box-shadow:inset 0 0 0 3px rgba(100,150,200,.5)}div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner{border:0}div:where(.swal2-container) .swal2-html-container{z-index:1;justify-content:center;margin:1em 1.6em .3em;padding:0;overflow:auto;color:inherit;font-size:1.125em;font-weight:normal;line-height:normal;text-align:center;word-wrap:break-word;word-break:break-word}div:where(.swal2-container) input:where(.swal2-input),div:where(.swal2-container) input:where(.swal2-file),div:where(.swal2-container) textarea:where(.swal2-textarea),div:where(.swal2-container) select:where(.swal2-select),div:where(.swal2-container) div:where(.swal2-radio),div:where(.swal2-container) label:where(.swal2-checkbox){margin:1em 2em 3px}div:where(.swal2-container) input:where(.swal2-input),div:where(.swal2-container) input:where(.swal2-file),div:where(.swal2-container) textarea:where(.swal2-textarea){box-sizing:border-box;width:auto;transition:border-color .1s,box-shadow .1s;border:1px solid #d9d9d9;border-radius:.1875em;background:rgba(0,0,0,0);box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px rgba(0,0,0,0);color:inherit;font-size:1.125em}div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror{border-color:#f27474 !important;box-shadow:0 0 2px #f27474 !important}div:where(.swal2-container) input:where(.swal2-input):focus,div:where(.swal2-container) input:where(.swal2-file):focus,div:where(.swal2-container) textarea:where(.swal2-textarea):focus{border:1px solid #b4dbed;outline:none;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px rgba(100,150,200,.5)}div:where(.swal2-container) input:where(.swal2-input)::placeholder,div:where(.swal2-container) input:where(.swal2-file)::placeholder,div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder{color:#ccc}div:where(.swal2-container) .swal2-range{margin:1em 2em 3px;background:#fff}div:where(.swal2-container) .swal2-range input{width:80%}div:where(.swal2-container) .swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}div:where(.swal2-container) .swal2-range input,div:where(.swal2-container) .swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}div:where(.swal2-container) .swal2-input{height:2.625em;padding:0 .75em}div:where(.swal2-container) .swal2-file{width:75%;margin-right:auto;margin-left:auto;background:rgba(0,0,0,0);font-size:1.125em}div:where(.swal2-container) .swal2-textarea{height:6.75em;padding:.75em}div:where(.swal2-container) .swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:rgba(0,0,0,0);color:inherit;font-size:1.125em}div:where(.swal2-container) .swal2-radio,div:where(.swal2-container) .swal2-checkbox{align-items:center;justify-content:center;background:#fff;color:inherit}div:where(.swal2-container) .swal2-radio label,div:where(.swal2-container) .swal2-checkbox label{margin:0 .6em;font-size:1.125em}div:where(.swal2-container) .swal2-radio input,div:where(.swal2-container) .swal2-checkbox input{flex-shrink:0;margin:0 .4em}div:where(.swal2-container) label:where(.swal2-input-label){display:flex;justify-content:center;margin:1em auto 0}div:where(.swal2-container) div:where(.swal2-validation-message){align-items:center;justify-content:center;margin:1em 0 0;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}div:where(.swal2-container) div:where(.swal2-validation-message)::before{content:"!";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}div:where(.swal2-container) .swal2-progress-steps{flex-wrap:wrap;align-items:center;max-width:100%;margin:1.25em auto;padding:0;background:rgba(0,0,0,0);font-weight:600}div:where(.swal2-container) .swal2-progress-steps li{display:inline-block;position:relative}div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step{z-index:20;flex-shrink:0;width:2em;height:2em;border-radius:2em;background:#2778c4;color:#fff;line-height:2em;text-align:center}div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#2778c4}div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line{z-index:10;flex-shrink:0;width:2.5em;height:.4em;margin:0 -1px;background:#2778c4}div:where(.swal2-icon){position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:2.5em auto .6em;border:0.25em solid rgba(0,0,0,0);border-radius:50%;border-color:#000;font-family:inherit;line-height:5em;cursor:default;user-select:none}div:where(.swal2-icon) .swal2-icon-content{display:flex;align-items:center;font-size:3.75em}div:where(.swal2-icon).swal2-error{border-color:#f27474;color:#f27474}div:where(.swal2-icon).swal2-error .swal2-x-mark{position:relative;flex-grow:1}div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;transform:rotate(45deg)}div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;transform:rotate(-45deg)}div:where(.swal2-icon).swal2-error.swal2-icon-show{animation:swal2-animate-error-icon .5s}div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark{animation:swal2-animate-error-x-mark .5s}div:where(.swal2-icon).swal2-warning{border-color:#facea8;color:#f8bb86}div:where(.swal2-icon).swal2-warning.swal2-icon-show{animation:swal2-animate-error-icon .5s}div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content{animation:swal2-animate-i-mark .5s}div:where(.swal2-icon).swal2-info{border-color:#9de0f6;color:#3fc3ee}div:where(.swal2-icon).swal2-info.swal2-icon-show{animation:swal2-animate-error-icon .5s}div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content{animation:swal2-animate-i-mark .8s}div:where(.swal2-icon).swal2-question{border-color:#c9dae1;color:#87adbd}div:where(.swal2-icon).swal2-question.swal2-icon-show{animation:swal2-animate-error-icon .5s}div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content{animation:swal2-animate-question-mark .8s}div:where(.swal2-icon).swal2-success{border-color:#a5dc86;color:#a5dc86}div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;transform:rotate(45deg);border-radius:50%}div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left]{top:-0.4375em;left:-2.0635em;transform:rotate(-45deg);transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right]{top:-0.6875em;left:1.875em;transform:rotate(-45deg);transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}div:where(.swal2-icon).swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-0.25em;left:-0.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}div:where(.swal2-icon).swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;transform:rotate(-45deg)}div:where(.swal2-icon).swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.8125em;width:1.5625em;transform:rotate(45deg)}div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;transform:rotate(-45deg)}div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip{animation:swal2-animate-success-line-tip .75s}div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long{animation:swal2-animate-success-line-long .75s}div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right{animation:swal2-rotate-success-circular-line 4.25s ease-in}[class^=swal2]{-webkit-tap-highlight-color:rgba(0,0,0,0)}.swal2-show{animation:swal2-show .3s}.swal2-hide{animation:swal2-hide .15s forwards}.swal2-noanimation{transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{margin-right:initial;margin-left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}@keyframes swal2-toast-show{0%{transform:translateY(-0.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(0.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0deg)}}@keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-0.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-show{0%{transform:scale(0.7)}45%{transform:scale(1.05)}80%{transform:scale(0.95)}100%{transform:scale(1)}}@keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(0.5);opacity:0}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-0.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(0.4);opacity:0}50%{margin-top:1.625em;transform:scale(0.4);opacity:0}80%{margin-top:-0.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0deg);opacity:1}}@keyframes swal2-rotate-loading{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}@keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto !important}body.swal2-no-backdrop .swal2-container{background-color:rgba(0,0,0,0) !important;pointer-events:none}body.swal2-no-backdrop .swal2-container .swal2-popup{pointer-events:all}body.swal2-no-backdrop .swal2-container .swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll !important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static !important}}body.swal2-toast-shown .swal2-container{box-sizing:border-box;width:360px;max-width:100%;background-color:rgba(0,0,0,0);pointer-events:none}body.swal2-toast-shown .swal2-container.swal2-top{inset:0 auto auto 50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{inset:0 0 auto auto}body.swal2-toast-shown .swal2-container.swal2-top-start,body.swal2-toast-shown .swal2-container.swal2-top-left{inset:0 auto auto 0}body.swal2-toast-shown .swal2-container.swal2-center-start,body.swal2-toast-shown .swal2-container.swal2-center-left{inset:50% auto auto 0;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{inset:50% auto auto 50%;transform:translate(-50%, -50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{inset:50% 0 auto auto;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-start,body.swal2-toast-shown .swal2-container.swal2-bottom-left{inset:auto auto 0 0}body.swal2-toast-shown .swal2-container.swal2-bottom{inset:auto auto 0 50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{inset:auto 0 0 auto}'
  );
