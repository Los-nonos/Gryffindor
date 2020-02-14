import IPresenter from '../Base/IPresenter';
import User from '../../../../Domain/Entities/User';

class FindUserPresenter implements IPresenter {
  private result: User[];
  constructor(result: any) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    const data = this.result.map(user => {
      return {
        result: {
          id: user.Id,
          name: user.Name,
          email: user.Email,
          phone: user.Phone,
        },
      };
    });
    return { result: data };
  }
}

export default FindUserPresenter;
