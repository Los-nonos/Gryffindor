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
    return {
      user: {
        id: this.result.Id,
        name: this.result.Name,
        email: this.result.Email,
        phone: this.result.Phone,
      },
      token: this.token,
    };
  }
}

export default LoginPresenter;
