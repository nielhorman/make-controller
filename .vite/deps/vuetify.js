import {
  DisplaySymbol,
  IconSymbol,
  LocaleSymbol,
  ThemeSymbol,
  createDisplay,
  createIcons,
  createLocale,
  createTheme,
  useDisplay,
  useLayout,
  useLocale,
  useRtl,
  useTheme
} from "./chunk-B3QLXZUJ.js";
import {
  DefaultsSymbol,
  IN_BROWSER,
  createDefaults,
  defineComponent,
  getUid,
  mergeDeep
} from "./chunk-EFGW556N.js";
import {
  nextTick,
  reactive
} from "./chunk-FCIEKJNF.js";

// node_modules/vuetify/lib/framework.mjs
function createVuetify() {
  let vuetify = arguments.length > 0 && arguments[0] !== void 0 ? arguments[0] : {};
  const {
    blueprint,
    ...rest
  } = vuetify;
  const options = mergeDeep(blueprint, rest);
  const {
    aliases = {},
    components = {},
    directives = {}
  } = options;
  const defaults = createDefaults(options.defaults);
  const display = createDisplay(options.display, options.ssr);
  const theme = createTheme(options.theme);
  const icons = createIcons(options.icons);
  const locale = createLocale(options.locale);
  const install = (app) => {
    for (const key in directives) {
      app.directive(key, directives[key]);
    }
    for (const key in components) {
      app.component(key, components[key]);
    }
    for (const key in aliases) {
      app.component(key, defineComponent({
        ...aliases[key],
        name: key,
        aliasName: aliases[key].name
      }));
    }
    theme.install(app);
    app.provide(DefaultsSymbol, defaults);
    app.provide(DisplaySymbol, display);
    app.provide(ThemeSymbol, theme);
    app.provide(IconSymbol, icons);
    app.provide(LocaleSymbol, locale);
    if (IN_BROWSER && options.ssr) {
      const {
        mount
      } = app;
      app.mount = function() {
        const vm = mount(...arguments);
        nextTick(() => display.update());
        app.mount = mount;
        return vm;
      };
    }
    getUid.reset();
    app.mixin({
      computed: {
        $vuetify() {
          return reactive({
            defaults: inject.call(this, DefaultsSymbol),
            display: inject.call(this, DisplaySymbol),
            theme: inject.call(this, ThemeSymbol),
            icons: inject.call(this, IconSymbol),
            locale: inject.call(this, LocaleSymbol)
          });
        }
      }
    });
  };
  return {
    install,
    defaults,
    display,
    theme,
    icons,
    locale
  };
}
var version = "3.0.0";
createVuetify.version = version;
function inject(key) {
  var _vm$parent, _vm$vnode$appContext;
  const vm = this.$;
  const provides = ((_vm$parent = vm.parent) == null ? void 0 : _vm$parent.provides) ?? ((_vm$vnode$appContext = vm.vnode.appContext) == null ? void 0 : _vm$vnode$appContext.provides);
  if (provides && key in provides) {
    return provides[key];
  }
}
export {
  createVuetify,
  useDisplay,
  useLayout,
  useLocale,
  useRtl,
  useTheme,
  version
};
//# sourceMappingURL=vuetify.js.map
