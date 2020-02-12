import IPresenter from '../Base/IPresenter';

class EditHostelPresenter implements IPresenter {
  private result: any;
  constructor(result: any) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return {
      data: {
        id: this.result.Id,
        name: this.result.Name,
        address: this.result.Address,
        email: this.result.Email,
        cuit: this.result.Cuit,
        tinyDescription: this.result.TinyDescription,
      },
    };
  }
}

export default EditHostelPresenter;
