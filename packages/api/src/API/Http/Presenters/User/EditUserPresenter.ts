import IPresenter from '../Base/IPresenter';

class EditUserPresenter implements IPresenter {
  private result: any;
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

export default EditUserPresenter;
