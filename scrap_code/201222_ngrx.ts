//==========
// Action
//==========

export enum SessionActionTypes {
  LoadSessions = '[Session] Load',
  LoginSessions = '[Session] Login',
  LogoutSessions = '[Session] Logout',
}

export class LoadSessions implements Action {
  readonly type = SessionActionTypes.LoadSessions;
}

export class LoginSessions implements Action {
  readonly type = SessionActionTypes.LoginSessions;
}

export class LogoutSessions implements Action {
  readonly type = SessionActionTypes.LogoutSessions;
}

export type SessionActions = LoadSessions | LoginSessions | LogoutSessions;

//==========
// Components
//==========

export class AppComponent {
  constructor(private store: Store<fromCore.State>) {
    this.store.dispatch(new LoadSessions());
  }

  login() {
    this.store.dispatch(new LoginSessions());
  }

  logout() {
    this.store.dispatch(new LogoutSessions());
  }
}

//==========
// State
//==========

export interface State {
  session: { login: boolean }
}

export const initialState: State = {
  session: { login: false }
}

//==========
// Reducer
//==========

export function reducer(
  state = initialState,
  action: SessionActions,
): State {
  switch (action.type) {
    case SessionActionTypes.LoadSessions: {
      return { ...state };
    }
    case SessionActionTypes.LoginSessions: {
      return { session: { login: true }}
    }
    case SessionActionTypes.LogoutSessions: {
      return { session: { login: false }}
    }
    default:
      return state;
  }
}

export const getSession = (state: State) => state.session

//==========
// User Ngrx
//==========

export class HeaderComponent implements OnInit {
  public session$: Observable<{login: boolean}>

  constructor(private store: Store<fromCore.State>) {
    this.session$ = this.store.select(fromCore.getSession)
  }

  ngOnInit() {}
}