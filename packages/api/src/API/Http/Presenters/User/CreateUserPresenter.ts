import IPresenter from '../Base/IPresenter';
import User from '../../../../Domain/Entities/User';

class CreateUserPresenter implements IPresenter {
  private result: User;
  constructor(result: any) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return {
      result: {
        id: this.result.Id,
        name: this.result.Name,
        email: this.result.Email,
        phone: this.result.Phone,
      },
    };
  }
}

export default CreateUserPresenter;
