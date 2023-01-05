import { Provider } from "react-redux";
import { BrowserRouter } from "react-router-dom";
// import RouterConfig from "navigation/RouterConfig";
import store from "redux/store";
import RouterConfig from "routes/RouterConfig";

function App(): JSX.Element {
  return (
    <Provider store={store}>
      <BrowserRouter>
        <RouterConfig />
      </BrowserRouter>
    </Provider>
  );
}
export default App;
