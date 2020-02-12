import IPresenter from '../Base/IPresenter';
import Hostel from '../../../../Domain/Entities/Hostel';

class CreateHostelPresenter implements IPresenter {
  private result: Hostel;
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

export default CreateHostelPresenter;
