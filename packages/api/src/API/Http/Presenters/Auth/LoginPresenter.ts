import IPresenter from '../Base/IPresenter';
import User from '../../../../Domain/Entities/User';

class LoginPresenter implements IPresenter {
  private result: User;
  private token: string;
  constructor(result: User, token: string) {
    this.result = result;
    this.token = token;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return { result: this.result, token: this.token };
  }
}

export default LoginPresenter;
